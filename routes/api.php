<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingsController;
use App\Http\Controllers\ListingModelsController;
use App\Http\Controllers\ModelStatController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/listings', [ListingsController::class, 'index']);
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::delete('/listings/{id}', [ListingsController::class, 'destroy']);
    Route::put('/listings/{id}', [ListingsController::class, 'update']);
    
    Route::get('/urls', [ListingsController::class, 'getUrls']);

    Route::get('/models', [ListingModelsController::class, 'index']);

    Route::get('/stats', [ModelStatController::class, 'index']);
});