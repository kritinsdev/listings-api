<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingsController;
use App\Http\Controllers\PhoneModelsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::get('/listings', [ListingsController::class, 'index']);
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::get('/listings/{id}', [ListingsController::class, 'show']);
    Route::put('/listings/{id}', [ListingsController::class, 'update']);
    Route::delete('/listings/{id}', [ListingsController::class, 'destroy']);

    Route::get('/models', [PhoneModelsController::class, 'index']);
});