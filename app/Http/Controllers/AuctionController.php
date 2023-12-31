<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionStoreRequest;
use App\Models\Auction;
use App\Models\Bid;
use DB;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auction::orderBy('created_at', 'desc')->get();
        return view('example.auction')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auction.create-auction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuctionStoreRequest $request)
    {
        $validated = $request->validated();

        $auction = new Auction();

        $auction->seller_id = auth()->user()->id;
        $auction->title = $validated['title'];
        $auction->description = $validated['description'];
        $auction->asking_price = $validated['asking_price'];
        $auction->buy_now_price = $validated['buy_now_price'];
        $auction->top_bid_amount = $validated['asking_price'];
        $auction->ends_at = $validated['ends_at'];

        $path = $request->file('image')->store('public/images');
        $auction->image_url = $path;
        $auction->save();

        return redirect()->route('auctions.index');
    }

    public function closeAuction(string $id)
    {
        $auction = Auction::find($id);
        if (!$auction) {
            abort(404);
        }

        $topBidder = Bid::where('auction_id', $id)->latest()->first();

        $auction->winner_id = $topBidder->user_id;
        $auction->save();

        return redirect()->route('auctions.show', $id)->with('success', 'Auction closed successfully');
    }

    public function checkout(string $id)
    {
        $auction = Auction::find($id);
        $recommendations = Auction::orderBy('created_at', 'desc')->limit(4)->get();
        return view('auction.checkout')->with(compact('auction', 'recommendations'));
    }

    public function buyNow(string $id)
    {
        $auction = Auction::find($id);
        if (!$auction) {
            abort(404);
        }

        DB::transaction(function () use ($auction, $id) {
            // set the winner to the current user
            $auction->winner_id = auth()->user()->id;
            $auction->top_bid_amount = $auction->buy_now_price;
            $auction->save();

            // add the bid to the database
            $bid = new Bid();
            $bid->user_id = auth()->user()->id;
            $bid->auction_id = $id;
            $bid->amount = $auction->buy_now_price;
            $bid->save();
        });

        return redirect()->route('auctions.show', $id);
    }

    public function wishlist(string $id)
    {
        $auction = Auction::find($id);
        if (!$auction) {
            abort(404);
        }

        // if the auction is already wishlisted, un-wishlist it
        if ($auction->wishlists()->where('user_id', auth()->user()->id)->exists()) {
            $auction->wishlists()->where('user_id', auth()->user()->id)->delete();
            return redirect()->route('auctions.show', $id)->with('success', 'Removed from wishlist');
        }

        $auction->wishlists()->create([
            'user_id' => auth()->user()->id,
            'auction_id' => $id
        ]);

        return redirect()->route('auctions.show', $id)->with('success', 'Added to wishlist');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auction = Auction::find($id);
        if (!$auction) {
            abort(404);
        }

        $wishlisted = $auction->wishlists()->where('user_id', auth()->user()->id)->exists();
        $minBidAmount = ceil($auction->top_bid_amount + ($auction->top_bid_amount * 0.1));
        $data = Auction::orderBy('created_at', 'desc')->limit(12)->get();

        return view('auction.show-auction')->with(compact('auction', 'minBidAmount', 'data', 'wishlisted'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auction = Auction::find($id);

        $auction->delete();
        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully');
    }
}
