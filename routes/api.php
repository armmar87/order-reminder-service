<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationIntervalController;


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('orders', OrderController::class);
    Route::patch('intervals', [NotificationIntervalController::class, 'updateIntervals']);
});


Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
