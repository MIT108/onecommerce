<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SubscribeController;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('subscribe')->group(function () {
    Route::post('/create', [SubscribeController::class, 'create'])->name('add.subscriber');
});


Route::prefix('homepage')->group(function () {
    Route::get('/banner', [HomePageController::class, 'getBanner'])->name('home.banner');
    Route::get('/home', [HomePageController::class, 'getHome'])->name('get.home');
});


