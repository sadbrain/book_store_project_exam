<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_role = config("constants.role.user_comp");
        $customer_role = config("constants.role.user_cust");
        $company_role_id = DB::table("roles")->where('name', $company_role) -> value("id");
        $customer_role_id = DB::table("roles")->where('name', $customer_role) -> value("id");
                // Create an admin user
        DB::table('users')->insert(
            [  [
                'name' => 'Company',
                'email' => 'company@gmail.com',
                'password' => Hash::make('Company@123'), 
                'phone'=> '0353537180',// Hash the password
                'street_address'=> '99 Tô Hiến Thành, Lê Hữu Trác',
                'district_address'=> 'Sơn Trà',
                'city'=> 'Đà Nẵng',
                'avatar'=> 'https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg',
                'role_id' => $company_role_id,
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('Customer@123'), 
                'phone'=> '0353537180',
                'street_address'=> '99 Tô Hiến Thành, Lê Hữu Trác',
                'district_address'=> 'Sơn Trà',
                'city'=> 'Đà Nẵng',
                'avatar'=> 'https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg',
                'role_id' => $customer_role_id,
                'company_id' => null, // Add the company_id here
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
