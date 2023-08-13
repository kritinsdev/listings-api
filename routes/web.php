<?php

use App\Http\Controllers\InventoryController;
use App\Http\Resources\ListingResource;
use App\Models\Listing;
use App\Models\ModelStat;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $today = Carbon::today()->toDateString();
        $listingsQuery = Listing::with('listingModel')
            // ->where('model_id', '<', 87)
            // ->whereDate('added', $today)
            ->orderBy('added', 'desc');

        $listings = ListingResource::collection($listingsQuery->paginate(1));

        return view('home', [
            'listings' => $listings
        ]);
    })->name('home');

    Route::get('/test', function () {
        return view('test');
    });

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
});

require __DIR__ . '/auth.php';