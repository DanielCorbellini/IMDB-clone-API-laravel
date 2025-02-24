<?php

namespace App\services;

use App\Models\StreamPlatform;
use Illuminate\Support\Facades\Http;

class StreamPlatformService
{

    public function getStreamPlatformFromDatabase()
    {
        return StreamPlatform::all();
    }

    public function getStreamPlatformFromAPI()
    {
        $response = Http::get('http://127.0.0.1:8000/api/stream/list');
        return $response->successful() ? json_decode($response->body(), true) : [];
    }

    public function getSpecificStreamPlatform($id)
    {
        return StreamPlatform::find($id);
    }

    public function createStreamPlatform($data)
    {
        return StreamPlatform::create($data);
    }

    public function deleteStreamPlatform($id)
    {
        $streamPlatform = $this->getSpecificStreamPlatform($id);

        if (!$streamPlatform) return false;

        StreamPlatform::destroy($id);

        return true;
    }
}
