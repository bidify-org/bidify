<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuctionPlaceBidRequest;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Validation\Rule;
use DB;
use App\Models\User;

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

    public function placeBid(Request $request, $auctionId)
    {

        // $auctionId = (int) $auctionId;
    // $this->authorize('placeBid', Bid::class);

    // // Validate the request using the form request class
    // $request->validate([
    //     'amount' => 'required|numeric'
    // ]);


    // $bid = Bid::create([
    //     'auction_id' => $auctionId,
    //     'amount' => $request->input('amount'),
    // ]);

    // // You can perform additional actions or return a response here

    // return redirect()->route('bidders.index', ['auctionId' => $auctionId])
    //     ->with('success', 'Bid placed successfully!');
            
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $bid = Bid::create([ 
            'user_id' => auth()->user()->id, 
            'auction_id' => $auctionId,
            'amount' => $request->input('amount')]);
    }
}