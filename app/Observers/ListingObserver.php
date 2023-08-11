<?php

namespace App\Observers;

use App\Models\Blacklist;
use App\Models\Listing;
use App\Models\ModelStat;

class ListingObserver
{
    public function created(Listing $listing): void
    {
        $modelStat = ModelStat::firstOrCreate(
            ['model_id' => $listing->model_id],
            ['count' => 0, 'average_price' => 0]
        );
    
        $modelStat->increment('count');
    
        $prices = Listing::where('model_id', $listing->model_id)->orderBy('price')->pluck('price')->all();
        $count = count($prices);
        $median = ($count % 2)
            ? $prices[floor($count / 2)]
            : ($prices[$count / 2 - 1] + $prices[$count / 2]) / 2;
    
        $modelStat->average_price = $median;
        $modelStat->save();
    }

    public function updated(Listing $listing): void
    {

    }

    public function deleted(Listing $listing): void
    {
        $modelStat = ModelStat::where('model_id', $listing->model_id)->first();
        $modelStat->decrement('count');
    
        $prices = Listing::where('model_id', $listing->model_id)->orderBy('price')->pluck('price')->all();
        $count = count($prices);
        $median = ($count > 0)
            ? ($count % 2 ? $prices[floor($count / 2)] : ($prices[$count / 2 - 1] + $prices[$count / 2]) / 2)
            : 0;
    
        $modelStat->average_price = $median;
        $modelStat->save();
    
        $blacklist = new Blacklist;
        $blacklist->url = $listing->url;
        $blacklist->site = $listing->site;
        $blacklist->save();
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