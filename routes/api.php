<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchListController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/watchlist/list', [WatchListController::class, 'index']);
Route::post('/watchlist/create', [WatchListController::class, 'store']);
