<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Check if an admin user already exists to prevent duplicates
        if (DB::table('users')->where('email', 'admin@example.com')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'admin123',
                'role' => 'admin',
                'page_title' => 'Care Pharmacy Dashboard',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 