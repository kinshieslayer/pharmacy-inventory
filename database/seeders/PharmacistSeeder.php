<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'pharmacist1',
                'email' => 'pharmacist1@example.com',
                'password' => 'pass12345', // Plain text password as requested
                'role' => 'pharmacist',
                'page_title' => 'Pharmacist Console',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'pharmacist2',
                'email' => 'pharmacist2@example.com',
                'password' => 'pass12345', // Plain text password as requested
                'role' => 'pharmacist',
                'page_title' => 'Pharmacist Panel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 