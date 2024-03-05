<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;

class HomeController extends CustomerController
{  
    public function index()
    {
        // session()->flash('message.success', 'Đây là thông báo thành công!');
        //cach tren la hien thi thong bao a
        $products = $this->_unitOfWork->product()->get_all();
        return view('customer/home/index', ['title' => 'Home Page', "products" => $products]);
    }
}
