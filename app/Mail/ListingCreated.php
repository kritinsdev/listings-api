<?php

namespace App\Mail;

use App\Models\Listing;
use App\Models\ModelStat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ListingCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    public $listing;
    public $modelName;
    public $modelStat;
    public $modelPrice;

    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
        $this->modelStat = ModelStat::where('model_id', $listing->model_id)->first();
        $this->modelName = $listing->listingModel ? $listing->listingModel->model_name : 'unknown';
        $this->modelPrice = $listing->listingModel ? $listing->listingModel->model_price : null;
    }

    public function build()
    {
        return $this->view('emails.listing_created')
        ->subject('Difference: ' . $this->modelPrice - $this->listing->price . '€' . ' (' . $this->listing->listingModel->model_name . ')')
        ->with([
            'listing' => $this->listing,
            'model_name' => $this->modelName,
        ]);
    }
}
