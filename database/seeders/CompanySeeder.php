<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->insert([
            [
                'name' => 'Tech Solution',
                'phone_number' => '6669990000',
                'street_address' => '123 Tech St',
                'district_address' => 'IL', // Giả sử strict_address tương đương với district_address
                'city' => 'Tech City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vivid Books',
                'phone_number' => '7779990000',
                'street_address' => '999 Vid St',
                'district_address' => 'IL',
                'city' => 'Vid City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Readers Club',
                'phone_number' => '1113335555',
                'street_address' => '999 Main St',
                'district_address' => 'IL',
                'city' => 'Lala land',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
