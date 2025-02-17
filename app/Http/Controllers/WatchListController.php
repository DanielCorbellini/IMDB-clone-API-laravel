<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use App\Services\WatchlistService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
    protected $watchlistService;

    public function __construct(WatchlistService $watchlistService)
    {
        $this->watchlistService = $watchlistService;
    }

    public function index()
    {
        $movies = Watchlist::all();
        return response()->json($movies);
    }

    public function showView()
    {
        $movies = $this->watchlistService->getMoviesFromAPI();

        return view('watchlist.index', compact('movies'));
    }
}
