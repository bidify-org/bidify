<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionStoreRequest;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('example.create-auction');
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
        $auction->buy_now_price = $validated['asking_price'] * 3;
        $auction->top_bid_amount = $validated['asking_price'];
        $auction->ends_at = $validated['ends_at'];

        $path = $request->file('image')->store('public/images');
        $auction->image_url = Storage::url($path);
        $auction->save();

        return redirect()->route('auctions.index');
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

        $minBidAmount = ceil($auction->top_bid_amount + ($auction->top_bid_amount * 0.1));

        return view('auction.show-auction')->with(compact('auction', 'minBidAmount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
