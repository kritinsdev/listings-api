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
        $this->call(ListingModelsTableSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(UserSeeder::class);
    }
}
