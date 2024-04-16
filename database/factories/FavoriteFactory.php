<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Favorite::class;
    public function definition()
    {
        // Lấy danh sách tất cả các người dùng và các mục
        $users = User::all();
        $products = Product::all();

        // Chọn ngẫu nhiên một người dùng và một mục từ danh sách
        $user = $users->random();
        $product = $products->random();

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ];
    }
}
