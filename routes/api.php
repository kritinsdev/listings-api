<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListingsController;
use App\Http\Controllers\Api\ListingModelsController;
use App\Http\Controllers\Api\ListingDetailController;
use App\Http\Controllers\Api\ModelStatController;
use App\Http\Controllers\Api\BlacklistController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/listings', [ListingsController::class, 'index']);
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::delete('/listings/{id}', [ListingsController::class, 'destroy']);
    Route::put('/listings/{id}', [ListingsController::class, 'update']);

    Route::post('/details', [ListingDetailController::class, 'store']);
    
    Route::get('/urls', [ListingsController::class, 'getUrls']);

    Route::get('/models', [ListingModelsController::class, 'index']);

    Route::get('/stats', [ModelStatController::class, 'index']);

    Route::get('/blacklist', [BlacklistController::class, 'index']);
    Route::post('/blacklist', [BlacklistController::class, 'store']);
});