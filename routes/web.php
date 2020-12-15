<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Passport::routes();

Route::post('webhook', function () {
    Telegram::commandsHandler(true);

    return 'ok';
});

Route::get('/test', function () {
    $response = Telegram::setWebhook([
        'url' => 'https://9090e70416de.ngrok.io/webhook',
    ]);

    dd($response);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
