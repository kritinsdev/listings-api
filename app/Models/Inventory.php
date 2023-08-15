<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'bought_for',
        'date_bought',
        'sold_for',
        'date_sold',
        'target_price',
        'potential_profit',
        'profit',
        'imei',
    ];
}
