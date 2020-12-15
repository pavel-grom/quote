<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function() {
    Route::get('episodes', [\App\Http\Controllers\EpisodeController::class, 'index']);
    Route::get('episodes/{id}', [\App\Http\Controllers\EpisodeController::class, 'show']);

    Route::get('characters', [\App\Http\Controllers\CharacterController::class, 'index']);
    Route::get('characters/random', [\App\Http\Controllers\CharacterController::class, 'random']);

    Route::get('quotes', [\App\Http\Controllers\QuoteController::class, 'index']);
    Route::get('quotes/random', [\App\Http\Controllers\QuoteController::class, 'random']);

    Route::get('stats', [\App\Http\Controllers\StatController::class, 'totalCount']);
    Route::get('my-stats', [\App\Http\Controllers\StatController::class, 'myCount']);
});



