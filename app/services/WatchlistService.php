<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Watchlist;

class WatchlistService
{
    public function getWatchlistFromAPI()
    {
        $response = Http::get('http://127.0.0.1:8000/api/watchlist/list');
        return $response->successful() ? json_decode($response->body(), true) : [];
    }

    public function getWatchlistFromDatabase()
    {
        return Watchlist::all();
    }

    public function getSpecificWatchlist($id)
    {
        return Watchlist::find($id);
    }

    public function createWatchList($data)
    {
        return Watchlist::create($data);
    }

    public function deleteWatchList($id)
    {
        $watchlist = $this->getSpecificWatchlist($id);

        if (!$watchlist) {
            // Se o item não for encontrado, retorna false ou outra resposta
            return false;
        }
        Watchlist::destroy($id);

        return true;
    }
}
