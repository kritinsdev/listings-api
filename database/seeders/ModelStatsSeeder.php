<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ModelStat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Get distinct models
         $models = Listing::select('model_id')->distinct()->get();

         foreach ($models as $model) {
             $listings = Listing::where('model_id', $model->model_id)->get();
 
             $count = $listings->count();
             $average_price = $listings->average('price');
             $lowest_price = $listings->min('price');
 
             ModelStat::create([
                 'model_id' => $model->model_id,
                 'count' => $count,
                 'average_price' => $average_price,
                 'lowest_price' => $lowest_price,
             ]);
         }
    }
}
