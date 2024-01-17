<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InteractionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);



Route::middleware('auth:api')->group(function () {
    Route::resource('interactions', InteractionController::class)->only(['store']);
    Route::put('interactions/{id}', [InteractionController::class, 'update']);
    Route::get('interactions', [InteractionController::class, 'index']);
	Route::delete('interactions/{id}', [InteractionController::class, 'destroy']);
    Route::get('interactions/{id}/track-event', [InteractionController::class, 'trackEvent']);
    Route::post('interactions/statistics', [InteractionController::class, 'getStatistics']);
});