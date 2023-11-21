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
}
