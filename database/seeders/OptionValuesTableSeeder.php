<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('option_values')->insert([
            ['option_id' => 1, 'price' => 10.00, 'price_type' => 'fixed', 'position' => 1],
            ['option_id' => 2, 'price' => 20.00, 'price_type' => 'fixed', 'position' => 2],
            ['option_id' => 3, 'price' => 30.00, 'price_type' => 'fixed', 'position' => 3],
            ['option_id' => 4, 'price' => 40.00, 'price_type' => 'fixed', 'position' => 4],
            ['option_id' => 5, 'price' => 50.00, 'price_type' => 'fixed', 'position' => 5],
            ['option_id' => 6, 'price' => 60.00, 'price_type' => 'fixed', 'position' => 6],
            ['option_id' => 7, 'price' => 70.00, 'price_type' => 'fixed', 'position' => 7],
            ['option_id' => 8, 'price' => 80.00, 'price_type' => 'fixed', 'position' => 8],
            ['option_id' => 9, 'price' => 90.00, 'price_type' => 'fixed', 'position' => 9],
            ['option_id' => 10, 'price' => 100.00, 'price_type' => 'fixed', 'position' => 10],
        ]);
    }
}
