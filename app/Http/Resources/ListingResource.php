<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastPriceChange = $this->priceHistories()->latest('change_date')->first();
        $oldPrice = $lastPriceChange ? $lastPriceChange->old_price : null;

        $data = [
            'id' => $this->id,
            'model' => $this->listingModel->model_name,  
            'price' => $this->price,
            // 'full_title' => $this->listingDetail ? $this->listingDetail->full_title : null,
            // 'description' => $this->listingDetail ? $this->listingDetail->description : null,
            'memory' => $this->listingDetail ? $this->listingDetail->memory : null,
            // 'views' => $this->listingDetail ? $this->listingDetail->views : null,
            // 'location' => $this->listingDetail ? $this->listingDetail->location : null,
            'old_price' => $oldPrice,
            'average_model_price' => round($this->modelStats->average_price, 0),
            'price_history' => $this->priceHistories,
            'url' => $this->url,
            'site' => $this->site,
            'added' => $this->added,
        ];

        return $data;
    }
}
