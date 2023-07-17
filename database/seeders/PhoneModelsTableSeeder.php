<?php

namespace Database\Seeders;

use App\Models\PhoneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            '6', '6 Plus', '6S', '6S Plus', '7', '7 Plus', '8', '8 Plus', 'X', 'XR', 'XS', 'XS Max', '11', 
            '11 Pro', '11 Pro Max', '12', '12 Mini', '12 Pro', '12 Pro Max', '13', '13 Mini', '13 Pro', 
            '13 Pro Max', 'SE', '14', '14 Plus', '14 Pro', '14 Pro Max'
        ];

        foreach ($models as $modelName) {
            PhoneModel::create(['model_name' => $modelName]);
        }
    }
}
