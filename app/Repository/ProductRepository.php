<?php

namespace App\Repository;

use App\Repository\IRepository\IProductRepository;
use App\Repository\Repository;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductRepository extends Repository implements IProductRepository
{
    public function get_model()
    {
        return \App\Models\Product::class;
    }

    // public function getByCategoryId($categoryId)
    // {
    //     return DB::table('products')
    //         ->where('category_id', $categoryId)
    //         ->get();
    // }
    public function getByCategoryId($categoryId)
{
    return Product::where('category_id', $categoryId)->get();
}
}
