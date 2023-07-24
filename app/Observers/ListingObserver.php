<?php

namespace App\Observers;

use App\Models\Listing;
use App\Models\ModelStat;
use App\Models\PriceHistory;

class ListingObserver
{
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

    public function updated(Listing $listing): void
    {
            if ($listing->isDirty('price')) {
                PriceHistory::create([
                    'listing_id' => $listing->id,
                    'old_price' => $listing->getOriginal('price'),
                    'new_price' => $listing->price,
                    'change_date' => now(),
                ]);
            }

            $modelStat = ModelStat::where('model_id', $listing->model_id)->first();
            if ($modelStat) {
                $modelStat->average_price = Listing::where('model_id', $listing->model_id)->average('price');
                $modelStat->save();
            }
    }

    public function deleted(Listing $listing): void
    {
        $modelStat = ModelStat::where('model_id', $listing->model_id)->first();
        $modelStat->count = $modelStat->count - 1;
        $totalPrice = Listing::where('model_id', $listing->model_id)->sum('price');
        $modelStat->average_price = $totalPrice / $modelStat->count;
        $lowestPrice = Listing::where('model_id', $listing->model_id)->min('price');
        $modelStat->lowest_price = $lowestPrice;

        $modelStat->save();
    }

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