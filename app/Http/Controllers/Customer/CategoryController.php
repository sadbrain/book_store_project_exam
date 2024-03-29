<?php


namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends CustomerController
{
    //
    public function getAll(){
        $category = $this->_unitOfWork->category()->get_all();
        return response()->json(['data'=>$category]);
    }
}
