<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStat extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'count', 'average_price', 'lowest_price'];

    public $timestamps = false;

    public function listingModel()
    {
        return $this->belongsTo(ListingModel::class, 'model_id');
    }
}
