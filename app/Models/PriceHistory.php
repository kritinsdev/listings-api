<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['listing_id', 'old_price', 'new_price', 'change_date'];
}
