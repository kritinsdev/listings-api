<?php

namespace App\Observers;

use App\Models\Listing;
use App\Models\ModelStat;

class ListingObserver
{
    /**
     * Handle the Listing "created" event.
     */
    public function created(Listing $listing): void
    {
        $modelStat = ModelStat::firstOrCreate(
            ['model_id' => $listing->model_id],
            ['count' => 0, 'average_price' => 0, 'lowest_price' => $listing->price]
        );

        $modelStat->increment('count');
        $modelStat->average_price = Listing::where('model_id', $listing->model_id)->average('price');
        $modelStat->lowest_price = Listing::where('model_id', $listing->model_id)->min('price');
        $modelStat->save();
    }

    /**
     * Handle the Listing "updated" event.
     */
    public function updated(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "deleted" event.
     */
    public function deleted(Listing $listing): void
    {
           // Get related ModelStat record
    $modelStat = ModelStat::where('model_id', $listing->model_id)->first();

    // Decrease the count by 1
    $modelStat->count = $modelStat->count - 1;

    // Recalculate the average price
    $totalPrice = Listing::where('model_id', $listing->model_id)->sum('price');
    $modelStat->average_price = $totalPrice / $modelStat->count;

    // Get the lowest price
    $lowestPrice = Listing::where('model_id', $listing->model_id)->min('price');
    $modelStat->lowest_price = $lowestPrice;

    // Save the model
    $modelStat->save();
    }

    /**
     * Handle the Listing "restored" event.
     */
    public function restored(Listing $listing): void
    {
        //
    }

    /**
     * Handle the Listing "force deleted" event.
     */
    public function forceDeleted(Listing $listing): void
    {
        //
    }
}
