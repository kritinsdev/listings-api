<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function listings() {
        return $this->hasMany(Listing::class, 'model_id');
    }
    
    public function modelStats()
    {
        return $this->hasOne(ModelStat::class, 'model_id');
    }
}
