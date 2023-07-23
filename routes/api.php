<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingsController;
use App\Http\Controllers\PhoneModelsController;
use App\Http\Controllers\ModelStatController;

Route::prefix('v1')->group(function () {
    Route::get('/listings', [ListingsController::class, 'index']);
    Route::post('/listings', [ListingsController::class, 'store']);
    Route::get('/listings/{id}', [ListingsController::class, 'show']);
    Route::put('/listings/{id}', [ListingsController::class, 'update']);
    Route::delete('/listings/{id}', [ListingsController::class, 'destroy']);
    Route::get('/urls', [ListingsController::class, 'getUrls']);

    Route::get('/models', [PhoneModelsController::class, 'index']);

    Route::get('/stats', [ModelStatController::class, 'index']);
});