<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lặp qua mỗi người dùng và tạo một số lượng bản ghi favorites ngẫu nhiên cho mỗi người dùng
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            // Chọn một số lượng ngẫu nhiên của items cho mỗi người dùng
            $selectedProducts = $products->random(rand(1, 5));

            // Thêm mỗi item được chọn vào favorites của người dùng
            foreach ($selectedProducts as $product) {
                Favorite::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
