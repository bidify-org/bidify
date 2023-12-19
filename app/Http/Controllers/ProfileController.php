<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateAddress;
use App\Models\Auction;
use App\Models\Wishlist;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $wonAuctions = $user->wonAuctions()->get();
        $ownedAuctions = $user->auctions()->get();

        // Get each auction that the user has bid on
        $biddedAuctions = $user->bids()->get()->map(function ($bid) {
            return $bid->auction;
        });

        // Remove duplicates
        $biddedAuctions = $biddedAuctions->unique('id');

        // Get each bids for each auction with each user
        $biddedAuctions = $biddedAuctions->map(function ($auction) {
            $auction->bids = $auction->bids()->with('user')->latest()->get();

            return $auction;
        });

        $data = (object) [
            'user' => $user,
            'wonAuctions' => $wonAuctions,
            'ownedAuctions' => $ownedAuctions,
            'biddedAuctions' => $biddedAuctions,
        ];

        return view('profile.index')->with('data', $data);
    }

    public function updateAddress(ProfileUpdateAddress $request)
    {
        $user = auth()->user();
        $validated = $request->validated();

        $user->address = $validated['address'];
        $user->save();

        return redirect()->route('profile.index');
    }

    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->with('auction')->get();
        $recommendations = Auction::orderBy('created_at', 'desc')->limit(9)->get();
        return view('profile.wishlist')->with(compact('wishlists', 'recommendations'));
    }
}
