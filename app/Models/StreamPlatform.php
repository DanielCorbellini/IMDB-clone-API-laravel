<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about',
        'website'
    ];

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class, 'platform_id');
    }
}
