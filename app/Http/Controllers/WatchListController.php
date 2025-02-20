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
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'storyline' => 'required|string|max:200',
            'platform_id' => 'required|integer',
            'released' => 'boolean',
        ]);

        try {
            $watchlist = $this->watchlistService->createWatchList($validatedData);
            return response()->json($watchlist, 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => 'Falha ao salvar no banco.'], 500);
        }
    }

    public function show($id)
    {
        $movie = $this->watchlistService->getSpecificWatchlist($id);

        if (!$movie) {
            return response()->json(['message' => 'Item não encontrado'], 404);
        }

        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = $this->watchlistService->deleteWatchList($id);

        if ($movie) {
            return response()->json(['message' => 'Item deletado com sucesso.'], 200);
        }

        return response()->json(['message' => 'Item não encontrado'], 404);
    }
}
