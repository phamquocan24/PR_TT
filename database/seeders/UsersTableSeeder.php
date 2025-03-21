<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('uusers')->insert([
            ['first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john.doe@example.com', 'phone' => '1234567890', 'password' => Hash::make('password1'), 'role' => 'admin', 'last_login' => '2025-01-01 00:00:00'],
            ['first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'jane.doe@example.com', 'phone' => '1234567891', 'password' => Hash::make('password2'), 'role' => 'user', 'last_login' => '2025-01-02 00:00:00'],
            ['first_name' => 'Alice', 'last_name' => 'Smith', 'email' => 'alice.smith@example.com', 'phone' => '1234567892', 'password' => Hash::make('password3'), 'role' => 'user', 'last_login' => '2025-01-03 00:00:00'],
            ['first_name' => 'Bob', 'last_name' => 'Johnson', 'email' => 'bob.johnson@example.com', 'phone' => '1234567893', 'password' => Hash::make('password4'), 'role' => 'user', 'last_login' => '2025-01-04 00:00:00'],
            ['first_name' => 'Charlie', 'last_name' => 'Brown', 'email' => 'charlie.brown@example.com', 'phone' => '1234567894', 'password' => Hash::make('password5'), 'role' => 'user', 'last_login' => '2025-01-05 00:00:00'],
            ['first_name' => 'David', 'last_name' => 'Wilson', 'email' => 'david.wilson@example.com', 'phone' => '1234567895', 'password' => Hash::make('password6'), 'role' => 'user', 'last_login' => '2025-01-06 00:00:00'],
            ['first_name' => 'Eve', 'last_name' => 'Davis', 'email' => 'eve.davis@example.com', 'phone' => '1234567896', 'password' => Hash::make('password7'), 'role' => 'user', 'last_login' => '2025-01-07 00:00:00'],
            ['first_name' => 'Frank', 'last_name' => 'Miller', 'email' => 'frank.miller@example.com', 'phone' => '1234567897', 'password' => Hash::make('password8'), 'role' => 'user', 'last_login' => '2025-01-08 00:00:00'],
            ['first_name' => 'Grace', 'last_name' => 'Lee', 'email' => 'grace.lee@example.com', 'phone' => '1234567898', 'password' => Hash::make('password9'), 'role' => 'user', 'last_login' => '2025-01-09 00:00:00'],
            ['first_name' => 'Hank', 'last_name' => 'Taylor', 'email' => 'hank.taylor@example.com', 'phone' => '1234567899', 'password' => Hash::make('password10'), 'role' => 'user', 'last_login' => '2025-01-10 00:00:00'],
        ]);
    }
}
