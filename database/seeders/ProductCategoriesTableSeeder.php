<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            ['product_id' => 1, 'category_id' => 1],
            ['product_id' => 2, 'category_id' => 2],
            ['product_id' => 3, 'category_id' => 3],
            ['product_id' => 4, 'category_id' => 4],
            ['product_id' => 5, 'category_id' => 5],
            ['product_id' => 6, 'category_id' => 6],
            ['product_id' => 7, 'category_id' => 7],
            ['product_id' => 8, 'category_id' => 8],
            ['product_id' => 9, 'category_id' => 9],
            ['product_id' => 10, 'category_id' => 10],
        ]);
    }
}
