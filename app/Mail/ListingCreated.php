<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ListingCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    public $listing;
    public $model_name;

    /**
     * Create a new message instance.
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
        $this->model_name = $listing->phoneModel ? $listing->phoneModel->model_name : 'Unknown';
    }

    public function build()
    {
        return $this->view('emails.listing_created')
        ->subject('ADDED: iPhone' . $this->listing->phoneModel->model_name . ' / PRICE: ' . $this->listing->price . '€')
        ->with([
            'listing' => $this->listing,
            'model_name' => $this->model_name
        ]);
    }
}
