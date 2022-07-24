<?php

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

Route::any('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::middleware('auth:api')->group(function () {
    Route::post('/user', [\App\Http\Controllers\Auth\AuthController::class, 'getUser']);
    Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout']);
});

Route::controller(\App\Http\Controllers\AdsController::class)->prefix('ads')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
});
