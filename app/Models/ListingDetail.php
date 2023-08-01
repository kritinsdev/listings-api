<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'memory',
        'full_title',
        'description',
        'views',
        'location',
    ];

    public $timestamps = false;

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
