<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'price',
        'memory',
        'added',
        'url',
        'site'
    ];
    protected $casts = [
        'added' => 'datetime',
    ];

    protected $dates = ['added'];

    public $timestamps = false;
    
    public function listingModel()
    {
        return $this->belongsTo(ListingModel::class, 'model_id');
    }

    public function modelStats()
    {
        return $this->hasOne(ModelStat::class, 'model_id', 'model_id');
    }
}