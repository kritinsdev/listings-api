<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriesSeeder::class);
        $this->call(ListingModelsTableSeeder::class);
        $this->call(ListingsSeeder::class);
        $this->call(ModelStatsSeeder::class);
        $this->call(PriceHistories::class);
        $this->call(BlacklistSeeder::class);
    }
}
