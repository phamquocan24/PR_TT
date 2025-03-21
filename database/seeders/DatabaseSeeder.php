<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductsTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            ProductVariationsTableSeeder::class,
            VariationsTableSeeder::class,
            VariationValuesTableSeeder::class,
            BrandsTableSeeder::class,
            ProductOptionsTableSeeder::class,
            OptionsTableSeeder::class,
            OptionValuesTableSeeder::class,
        ]);
    }
}
