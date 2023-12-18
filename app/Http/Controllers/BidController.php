<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionPlaceBidRequest;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Validation\Rule;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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

    $topBid = Bid::where('auction_id', $auctionId)->max('amount');

    $validator = Validator::make($request->all(), [
        'amount' => 'required|numeric|min:' . ($topBid + 50000),
    ]);

    if ($validator->fails()) {

        return redirect()->route('auctions.show', $auctionId)
            ->withErrors([
                'message' => 'Bid does not reach minimum amount',
            ]);
    } 
        $bid = new Bid();

        $bid->user_id = auth()->user()->id;
        $bid->auction_id = $auctionId;
        $bid->amount = $request->validated(['amount']);

        $bid->save();
        

        return redirect()->route('auctions.show', $auctionId);
    }
}