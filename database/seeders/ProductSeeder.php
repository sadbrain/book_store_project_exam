<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Fortune of Time',
                'slug' => Str::slug("Fortune of Time"),
                'author' => 'Billy Spark',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'SWD9999001',
                'list_price' => 99,
                'price' => 90,
                'price50' => 85,
                'price100' => 80,
                'category_id' => 1,
                "image_url" => "\images\product/1136dd2a-316e-4180-84fa-fe95088e69cd.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Dark Skies',
                'slug' => Str::slug("Dark Skies"),
                'author' => 'Nancy Hoover',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'CAW777777701',
                'list_price' => 40,
                'price' => 30,
                'price50' => 25,
                'price100' => 20,
                'category_id' => 1,
                "image_url" => "\images\product/e8064fd8-4d6d-4715-8450-061cb6ea9c15.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Vanish in the Sunset',
                'slug' => Str::slug("Vanish in the Sunset"),
                'author' => 'Julian Button',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'RITO5555501',
                'list_price' => 55,
                'price' => 50,
                'price50' => 40,
                'price100' => 35,
                'category_id' => 1,
                "image_url" => "\images\product/41ba8176-a85b-40cc-80de-d7605bff3526.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Cotton Candy',
                'slug' => Str::slug("Cotton Candy"),
                'author' => 'Abby Muscles',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'WS3333333301',
                'list_price' => 70,
                'price' => 65,
                'price50' => 60,
                'price100' => 55,
                'category_id' => 2,
                "image_url" => "\images\product\90c79de3-9bcf-4a0f-a8cc-431388006a9a.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Rock in the Ocean',
                'slug' => Str::slug("Rock in the Ocean"),
                'author' => 'Ron Parker',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'SOTJ1111111101',
                'list_price' => 30,
                'price' => 27,
                'price50' => 25,
                'price100' => 20,
                'category_id' => 2,
                "image_url" => "\images\product\b3e121ee-f705-4c0c-822a-6239256f7995.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Leaves and Wonders',
                'slug' => Str::slug("Leaves and Wonders"),
                'author' => 'Laura Phantom',
                'description' => 'Praesent vitae sodales libero. Praesent molestie orci augue, vitae euismod velit sollicitudin ac. Praesent vestibulum facilisis nibh ut ultricies.\r\n\r\nNunc malesuada viverra ipsum sit amet tincidunt.',
                'isbn' => 'FOT000000001',
                'list_price' => 25,
                'price' => 23,
                'price50' => 22,
                'price100' => 20,
                'category_id' => 3,
                "image_url" => "\images\product/e1596061-9fcc-4e39-b97a-f19f0beaff39.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm dữ liệu cho các sản phẩm khác
        ]);

    }
}
