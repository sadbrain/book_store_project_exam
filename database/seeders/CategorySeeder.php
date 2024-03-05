<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                "name" => "Action",
                "slug" => Str::slug("Action"),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => "SciFi",
                "slug" => Str::slug("SciFi"),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => "History",
                "slug" => Str::slug("History"),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}