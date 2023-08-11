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
        $data = [
            'id' => $this->id,
            'model' => $this->listingModel->model_name,  
            'price' => $this->price,
            'memory' => $this->listingDetail ? $this->listingDetail->memory : null,
            'url' => $this->url,
            'site' => $this->site,
            'added' => $this->added,
        ];

        return $data;
    }
}
