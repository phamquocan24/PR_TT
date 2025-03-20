<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_variations')->insert([
            ['product_id' => 1, 'variation_id' => 1],
            ['product_id' => 2, 'variation_id' => 2],
            ['product_id' => 3, 'variation_id' => 3],
            ['product_id' => 4, 'variation_id' => 4],
            ['product_id' => 5, 'variation_id' => 5],
            ['product_id' => 6, 'variation_id' => 6],
            ['product_id' => 7, 'variation_id' => 7],
            ['product_id' => 8, 'variation_id' => 8],
            ['product_id' => 9, 'variation_id' => 9],
            ['product_id' => 10, 'variation_id' => 10],
        ]);
    }
}

