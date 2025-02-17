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
        $movies = $this->watchlistService->getWatchlistFromDatabase();
        return response()->json($movies);
    }

    public function showView()
    {
        $movies = $this->watchlistService->getWatchlistFromAPI();
        return view('watchlist.index', compact('movies'));
    }

    public function store(Request $request)
    {
        // TODO
        //$validatedData = $request->validate([]);

        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'storyline' => 'required|string|max:200',
            'platform_id' => 'required|integer',
            'released' => 'boolean',
        ]);

        $watchlist = $this->watchlistService->createWatchList($validatedData);

        return response()->json($watchlist, 201);
    }
}
