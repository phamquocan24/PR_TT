<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('variation_values')->insert([
            ['variation_id' => 1, 'value' => 'value-1', 'position' => 1],
            ['variation_id' => 2, 'value' => 'value-2', 'position' => 2],
            ['variation_id' => 3, 'value' => 'value-3', 'position' => 3],
            ['variation_id' => 4, 'value' => 'value-4', 'position' => 4],
            ['variation_id' => 5, 'value' => 'value-5', 'position' => 5],
            ['variation_id' => 6, 'value' => 'value-6', 'position' => 6],
            ['variation_id' => 7, 'value' => 'value-7', 'position' => 7],
            ['variation_id' => 8, 'value' => 'value-8', 'position' => 8],
            ['variation_id' => 9, 'value' => 'value-9', 'position' => 9],
            ['variation_id' => 10, 'value' => 'value-10', 'position' => 10],
        ]);
    }
}
