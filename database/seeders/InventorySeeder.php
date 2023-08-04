<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::truncate();

        $data = [
            [
                'model' => 'iPhone 11',
                'bought_for' => 150,
                'date_bought' => Carbon::create(2023, 7, 24),
                'sold_for' => 200,
                'date_sold' => Carbon::create(2023, 8, 1),
                'profit' => 50,
                'imei' => '352990117419131',
            ],
            [
                'model' => 'iPhone 11',
                'bought_for' => 180,
                'date_bought' => Carbon::create(2023, 7, 27),
                'sold_for' => 270,
                'date_sold' => Carbon::create(2023, 8, 3),
                'profit' => 90,
                'imei' => '356578109856117',
            ],
            [
                'model' => 'iPhone 12',
                'bought_for' => 250,
                'date_bought' => Carbon::create(2023, 7, 28),
                'imei' => null,
            ],
            [
                'model' => 'iPhone 11',
                'bought_for' => 140,
                'date_bought' => Carbon::create(2023, 8, 4),
                'imei' => null,
            ],
        ];

        foreach ($data as $item) {
            Inventory::create($item);
        }
    }
}
