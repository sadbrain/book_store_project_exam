<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends CustomerController
{

    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;

        // Lấy tất cả các bản ghi từ bảng Favorite với thông tin sản phẩm và người dùng
        $favorites = Favorite::join('products', 'favorites.product_id', '=', 'products.id')
            ->join('users', 'favorites.user_id', '=', 'users.id') // So sánh user_id với id của users
            ->where('favorites.user_id', $user_id) // Lọc theo user_id của người dùng hiện tại
            ->select('favorites.*', 'products.*', 'users.*')
            ->get();
        // return response()->json($favorites);

        return view("customer/favorite/index", compact('favorites'));
    }


    public function add($product_id)
    {
        // $user = Auth::user();
        // $user_id = $user->id;
        $user = Auth::user();
        // $user_id = $user->id;
        $user_id = 2;
        // Chỉ lấy product_id từ yêu cầu
        $data = Favorite::where('user_id', $user_id)
            ->where('product_id', $product_id) // Sửa lại thành $product_id
            ->first();

        if (!$data) {
            $favorite = Favorite::create([
                'user_id' => $user_id,
                'product_id' => $product_id // Sửa lại thành $product_id
            ]);
        }
        // Hiển thị thông báo flash và chuyển hướng người dùng
        session()->flash("message.success", "Product added to favorites successfully");
        return redirect("/");
    }
}
