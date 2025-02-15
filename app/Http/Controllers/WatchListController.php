<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
    public function index()
    {
        $movies = Watchlist::all();
        return response()->json($movies);
    }

    public function showView()
    {
        $response = Http::get('http://127.0.0.1:8000/watchlist/api');

        $movies = [];
        if ($response->successful()) {
            $movies = $response->json();
        }

        return view('watchlist.index', compact('movies'));
    }
}
