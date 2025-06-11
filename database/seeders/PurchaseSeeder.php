<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchases')->insert([
            [
                'customer_name' => 'John Doe',
                'phone_number' => '111-222-3333',
                'product_id' => 1,
                'quantity' => 5,
                'total_price' => 5 * 10.99, // Assuming drug_id 1 is Amoxicillin at $10.99
                'purchase_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Jane Smith',
                'phone_number' => '444-555-6666',
                'product_id' => 2,
                'quantity' => 10,
                'total_price' => 10 * 5.25, // Assuming drug_id 2 is Paracetamol at $5.25
                'purchase_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Peter Jones',
                'phone_number' => '777-888-9999',
                'product_id' => 3,
                'quantity' => 3,
                'total_price' => 3 * 7.50, // Assuming drug_id 3 is Ibuprofen at $7.50
                'purchase_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 