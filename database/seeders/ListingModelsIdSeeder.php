<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingModelsIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('listing_models')
            ->whereBetween('id', [1, 28])
            ->update(['category_id' => 1]);

        DB::table('listing_models')
            ->whereBetween('id', [29, 37])
            ->update(['category_id' => 2]);
    }
}