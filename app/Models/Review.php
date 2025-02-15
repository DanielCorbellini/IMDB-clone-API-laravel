<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'description',
        'watchlist_id',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function watchlist()
    {
        return $this->belongsTo(Watchlist::class, 'watchlist_id');
    }
}
