<?php

use App\Http\Controllers\StreamPlatformController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchListController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/watchlist/list', [WatchListController::class, 'index']);
Route::get('/watchlist/list/{id}', [WatchListController::class, 'show']);
Route::post('/watchlist/create', [WatchListController::class, 'store']);
Route::put('/watchlist/update/{watchlist}', [WatchListController::class, 'update']);
Route::delete('/watchlist/delete/{id}', [WatchListController::class, 'destroy']);

Route::get('/stream/list', [StreamPlatformController::class, 'index']);
Route::get('/stream/list/{id}', [StreamPlatformController::class, 'show']);
Route::post('/stream/create', [StreamPlatformController::class, 'store']);
Route::put('/stream/update/{streamPlatform}', [StreamPlatformController::class, 'update']);
Route::delete('/stream/delete/{id}', [StreamPlatformController::class, 'destroy']);
