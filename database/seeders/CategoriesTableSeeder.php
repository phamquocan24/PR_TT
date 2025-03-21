<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['parent_id' => null, 'slug' => 'category-1', 'position' => 1, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-2', 'position' => 2, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-3', 'position' => 3, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-4', 'position' => 4, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-5', 'position' => 5, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-6', 'position' => 6, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-7', 'position' => 7, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-8', 'position' => 8, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-9', 'position' => 9, 'is_searchable' => 1, 'is_active' => 1],
            ['parent_id' => null, 'slug' => 'category-10', 'position' => 10, 'is_searchable' => 1, 'is_active' => 1],
        ]);
    }
}
