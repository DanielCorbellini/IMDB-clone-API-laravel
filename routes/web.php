<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchListController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/watchlist/api', [WatchListController::class, 'index']);
Route::get('/watchlist/view', [WatchListController::class, 'showView']);
