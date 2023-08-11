<?php

use App\Http\Controllers\InventoryController;
use App\Http\Resources\ListingResource;
use App\Models\Listing;
use App\Models\ModelStat;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/latest', function () {
        $today = Carbon::yesterday()->toDateString();
        $listingsQuery = Listing::with('listingModel')
            ->where('model_id', '<', 87)
            ->whereDate('added', $today)
            ->orderBy('added', 'desc');

        $listings = ListingResource::collection($listingsQuery->paginate(25));
        return view('latest', [
            'listings' => $listings
        ]);
    })->name('latest');

    Route::get('/statistics', function () {
        return view('statistics');
    })->name('statistics');


    Route::get('/test', function () {
        return view('test');
    });

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
});

require __DIR__ . '/auth.php';