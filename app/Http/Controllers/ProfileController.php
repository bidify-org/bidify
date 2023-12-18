<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $wonAuctions = auth()->user()->wonAuctions()->get();
        $ownedAuctions = auth()->user()->auctions()->get();
        $bids = auth()->user()->bids()->get();

        $data = (object) [
            'wonAuctions' => $wonAuctions,
            'ownedAuctions' => $ownedAuctions,
            'bids' => $bids,
        ];

        return view('profile.index')->with('data', $data);
    }
}
