<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drugs')->insert([
            [
                'name' => 'Amoxicillin',
                'description' => 'Antibiotic used to treat a number of bacterial infections.',
                'price' => 15.50,
                'quantity' => 100,
                'expiry_date' => Carbon::now()->addMonths(6)->toDateString(),
                'prescription_required' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paracetamol',
                'description' => 'Pain reliever and fever reducer.',
                'price' => 5.25,
                'quantity' => 250,
                'expiry_date' => Carbon::now()->addYears(1)->toDateString(),
                'prescription_required' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ibuprofen',
                'description' => 'NSAID used for pain, fever, and inflammation.',
                'price' => 8.75,
                'quantity' => 150,
                'expiry_date' => Carbon::now()->addMonths(9)->toDateString(),
                'prescription_required' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lisinopril',
                'description' => 'ACE inhibitor used to treat high blood pressure.',
                'price' => 22.00,
                'quantity' => 75,
                'expiry_date' => Carbon::now()->addMonths(10)->toDateString(),
                'prescription_required' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omeprazole',
                'description' => 'Proton-pump inhibitor used to treat heartburn and acid reflux.',
                'price' => 12.99,
                'quantity' => 120,
                'expiry_date' => Carbon::now()->addMonths(11)->toDateString(),
                'prescription_required' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 