<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Watchlist;

class WatchlistService
{
    public function getMoviesFromAPI()
    {
        $response = Http::get('http://127.0.0.1:8001/watchlist/api');
        return $response->successful() ? json_decode($response->body(), true) : [];
    }

    public function getMoviesFromDatabase()
    {
        return Watchlist::all();
    }
}
