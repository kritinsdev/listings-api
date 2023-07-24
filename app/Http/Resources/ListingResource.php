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

        return [
            'id' => $this->id,
            'price' => $this->price,
            'old_price' => $oldPrice,
            'memory' => $this->memory,
            'battery_capacity' => $this->battery_capacity,
            'added' => $this->added,
            'url' => $this->url,
            'model' => $this->phoneModel->model_name,  
            'average_model_price' => round($this->modelStats->average_price, 0)
        ];
    }
}
