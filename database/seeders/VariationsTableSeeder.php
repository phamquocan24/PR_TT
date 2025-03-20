<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('variations')->insert([
            ['uid' => 'uid-1', 'type' => 'type-1', 'is_global' => 1, 'position' => 1],
            ['uid' => 'uid-2', 'type' => 'type-2', 'is_global' => 1, 'position' => 2],
            ['uid' => 'uid-3', 'type' => 'type-3', 'is_global' => 1, 'position' => 3],
            ['uid' => 'uid-4', 'type' => 'type-4', 'is_global' => 1, 'position' => 4],
            ['uid' => 'uid-5', 'type' => 'type-5', 'is_global' => 1, 'position' => 5],
            ['uid' => 'uid-6', 'type' => 'type-6', 'is_global' => 1, 'position' => 6],
            ['uid' => 'uid-7', 'type' => 'type-7', 'is_global' => 1, 'position' => 7],
            ['uid' => 'uid-8', 'type' => 'type-8', 'is_global' => 1, 'position' => 8],
            ['uid' => 'uid-9', 'type' => 'type-9', 'is_global' => 1, 'position' => 9],
            ['uid' => 'uid-10', 'type' => 'type-10', 'is_global' => 1, 'position' => 10],
        ]);
    }
}
