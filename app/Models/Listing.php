<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'category_id',
        'price',
        'added',
        'url',
        'site'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function listingModel()
    {
        return $this->belongsTo(ListingModel::class, 'model_id');
    }

    public function modelStats()
    {
        return $this->hasOne(ModelStat::class, 'model_id', 'model_id');
    }

    public function priceHistories()
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function listingDetail()
    {
        return $this->hasOne(ListingDetail::class);
    }
}