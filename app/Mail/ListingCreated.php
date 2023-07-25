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
    public $model_name;

    public $modelStat;

    /**
     * Create a new message instance.
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
        $this->modelStat = ModelStat::where('model_id', $listing->model_id)->first();
        $this->model_name = $listing->phoneModel ? $listing->phoneModel->model_name : 'Unknown';
    }

    public function build()
    {
        return $this->view('emails.listing_created')
        ->subject('Difference: +' . $this->modelStat->average_price - $this->listing->price . '€' . ' (iPhone' . $this->listing->phoneModel->model_name . ')')
        ->with([
            'listing' => $this->listing,
            'model_name' => $this->model_name
        ]);
    }
}
