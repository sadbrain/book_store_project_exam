<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Repository\CartRepository;
// use DB;
use Illuminate\Support\Facades\DB;
class ShoppingCartController extends CustomerController
{
    //add Item into the cart
    public function addToCart($id){
        $product = $this->_unitOfWork->product()->get($id);
        if (!$product){
            return response()->json(['error' =>'The product is not exits'], 404);
        }
        $cartItem = $this->_unitOfWork->cart()->get_all();
        $cartItem = $cartItem->whereRaw('product_id', $id)->get()->all();
        // $cartItem = CartRepository::where('product_id'. $id)->first();
        // $cartItem = DB::table('cart')->where('product_id', $id)->first();
        if ($cartItem){
            return response()->json(['error' =>'The Item is already exits'], 404);
        }
        $this->_unitOfWork->cart()->add($cartItem);
        return response()->json(['success' => 'The Item is added to cart is successful!']);
    }

    //get all Product in the cart table 
    public function showItemIntoCart(){
        $products = $this->_unitOfWork->cart()->get_all();
        return response()->json(['data' => $products]);
    }
}
