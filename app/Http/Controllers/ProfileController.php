<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateAddress;

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

    public function updateAddress(ProfileUpdateAddress $request)
    {
        $user = auth()->user();
        $validated = $request->validated();

        $user->address = $validated['address'];
        $user->save();

        return redirect()->route('profile.index');
    }
}
