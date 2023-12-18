<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $data = Auction::orderBy('created_at', 'desc')->limit(9)->get();
        return view('home.index')->with('data', $data);
    }

    public function profile(){
        $data = Auction::orderBy('created_at', 'desc')->get();
        return view('home.profile')->with('data', $data);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $data = Auction::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        } else {
            $data = Auction::all();
        }

        return view('home.search-result')->with('data', $data)->with('searchTerm', $searchTerm);
    }
}

