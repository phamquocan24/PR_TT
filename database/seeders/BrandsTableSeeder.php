<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('brands')->insert([
            ['slug' => 'brand-1', 'is_active' => 1],
            ['slug' => 'brand-2', 'is_active' => 1],
            ['slug' => 'brand-3', 'is_active' => 1],
            ['slug' => 'brand-4', 'is_active' => 1],
            ['slug' => 'brand-5', 'is_active' => 1],
            ['slug' => 'brand-6', 'is_active' => 1],
            ['slug' => 'brand-7', 'is_active' => 1],
            ['slug' => 'brand-8', 'is_active' => 1],
            ['slug' => 'brand-9', 'is_active' => 1],
            ['slug' => 'brand-10', 'is_active' => 1],
        ]);
    }
}
