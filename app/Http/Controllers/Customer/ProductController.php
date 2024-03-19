<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends CustomerController
{

    public function getAll()
    {
        $products = $this->_unitOfWork->product()->get_all();
        $products = $products->whereRaw('id < 4')->get()->all();
        foreach ($products as $product) {
            $product["category"] = $product->category;
        }
        return response()->json(["data" => $products]);
        // return view('customer/list-product', ['products' => $products]);
    }

    public function showProduct (){
        return view ('customer/list-product');
    }

        public function getByCategory($id = null){
            if ($id == null ){
                $id = $this->_unitOfWork->category()->get_all()->first()->id;
            }
            $products = $this->_unitOfWork->product()->get_all("id = $id")->get()->all();
            return response()->json(['data'=>$products]);
        }

}
