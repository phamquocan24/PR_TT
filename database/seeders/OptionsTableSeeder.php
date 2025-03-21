<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('options')->insert([
            ['type' => 'type-1', 'is_required' => 0, 'is_global' => 1, 'position' => 1],
            ['type' => 'type-2', 'is_required' => 0, 'is_global' => 1, 'position' => 2],
            ['type' => 'type-3', 'is_required' => 0, 'is_global' => 1, 'position' => 3],
            ['type' => 'type-4', 'is_required' => 0, 'is_global' => 1, 'position' => 4],
            ['type' => 'type-5', 'is_required' => 0, 'is_global' => 1, 'position' => 5],
            ['type' => 'type-6', 'is_required' => 0, 'is_global' => 1, 'position' => 6],
            ['type' => 'type-7', 'is_required' => 0, 'is_global' => 1, 'position' => 7],
            ['type' => 'type-8', 'is_required' => 0, 'is_global' => 1, 'position' => 8],
            ['type' => 'type-9', 'is_required' => 0, 'is_global' => 1, 'position' => 9],
            ['type' => 'type-10', 'is_required' => 0, 'is_global' => 1, 'position' => 10],
        ]);
    }
}
