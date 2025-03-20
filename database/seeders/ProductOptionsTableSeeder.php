<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_options')->insert([
            ['product_id' => 1, 'option_id' => 1],
            ['product_id' => 2, 'option_id' => 2],
            ['product_id' => 3, 'option_id' => 3],
            ['product_id' => 4, 'option_id' => 4],
            ['product_id' => 5, 'option_id' => 5],
            ['product_id' => 6, 'option_id' => 6],
            ['product_id' => 7, 'option_id' => 7],
            ['product_id' => 8, 'option_id' => 8],
            ['product_id' => 9, 'option_id' => 9],
            ['product_id' => 10, 'option_id' => 10],
        ]);
    }
}
