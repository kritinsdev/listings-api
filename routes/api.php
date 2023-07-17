<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::get('/listings', [LisstingsController::class, 'index']);
    Route::post('/listings', [LisstingsController::class, 'store']);
    Route::get('/listings/{id}', [LisstingsController::class, 'show']);
    Route::put('/listings/{id}', [LisstingsController::class, 'update']);
    Route::delete('/listings/{id}', [LisstingsController::class, 'destroy']);

    Route::get('/models', [PhoneModelsController::class, 'index']);
});