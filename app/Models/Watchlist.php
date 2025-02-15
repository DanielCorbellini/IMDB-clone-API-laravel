<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'storyline',
        'platform_id',
        'released'
    ];

    protected $casts = [
        'released' => 'boolean',
    ];

    public function platform()
    {
        return $this->belongsTo(StreamPlatform::class, 'platform_id');
    }
}
