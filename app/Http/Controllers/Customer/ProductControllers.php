<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductControllers extends CustomerController
{  

    public function show ($id){
        $product = $this->_unitOfWork->product()->get("id = $id");
        return view('/customer/product/detail', compact('product'));
    }
    public function showProduct()
    {
        return view('customer/list-product');
    }           
}