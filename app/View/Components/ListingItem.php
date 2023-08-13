<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListingItem extends Component
{
    public $listing;
    public function __construct($listing)
    {
        $this->listing = $listing;
    }

    public function render(): View|Closure|string
    {
        return view('components.listing-item');
    }
}
