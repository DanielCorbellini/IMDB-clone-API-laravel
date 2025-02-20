<?php

namespace App\services;

use App\Models\StreamPlatform;

class StreamPlatformService
{

    public function getStreamPlatformFromDatabase()
    {
        return StreamPlatform::all();
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
