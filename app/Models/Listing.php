<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'price',
        'memory',
        'battery_capacity',
        'added',
        'url',
    ];

    public $timestamps = false;

    public function phoneModel() {
        return $this->belongsTo(PhoneModel::class);
    }
}
