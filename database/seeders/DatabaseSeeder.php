<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CompanySeeder::class,
            CustomerUserSeeder::class,
            // Thêm các Seeder khác nếu có
        ]);
    }
}
