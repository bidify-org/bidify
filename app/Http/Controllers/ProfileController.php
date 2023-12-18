<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $wonAuctions = $user->wonAuctions()->get();
        $ownedAuctions = $user->auctions()->get();
        $bids = $user->bids()->get();

        $data = (object) [
            'user' => $user,
            'wonAuctions' => $wonAuctions,
            'ownedAuctions' => $ownedAuctions,
            'bids' => $bids,
        ];

        return view('profile.index')->with('data', $data);
    }
}
