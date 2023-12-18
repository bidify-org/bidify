<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionPlaceBidRequest;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Support\Facades\Validator;
use DB;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($auctionId)
    {
        $bidders = Bid::where('auction_id', $auctionId)->with('user')->get();
        return view('example.auction', compact('bidders'));
    }

    public function placeBid(AuctionPlaceBidRequest $request, $auctionId)
    {
        $currentMaxBidAmount = Bid::where('auction_id', $auctionId)->max('amount');
        $minBidAmount = $currentMaxBidAmount + ($currentMaxBidAmount * 0.1);

        $validated = $request->validated();

        if (((int) $validated['amount']) < $minBidAmount) {
            return redirect()
                ->route('auctions.show', $auctionId)
                ->withErrors([
                    'message' => 'Your bid does not reach the minimum amount of Rp' . number_format($minBidAmount),
                ]);
        }

        DB::transaction(function () use ($request, $auctionId) {
            $bid = new Bid();
            $bid->user_id = auth()->user()->id;
            $bid->auction_id = $auctionId;
            $bid->amount = $request->validated(['amount']);
            $bid->save();

            $currentAuction = Auction::find($auctionId);
            $currentAuction->buy_now_price = $request->validated(['amount']) * 3;
            $currentAuction->save();
        });


        return redirect()->route('auctions.show', $auctionId);
    }
}
