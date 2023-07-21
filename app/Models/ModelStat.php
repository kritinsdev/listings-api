<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStat extends Model
{
    use HasFactory;

    protected $fillable = ['model_id', 'count', 'average_price', 'lowest_price'];

    public function phoneModel()
    {
        return $this->belongsTo(PhoneModel::class, 'model_id');
    }
}
