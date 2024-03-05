<?php
namespace App\Repository;

use App\Repository\IRepository\IProductRepository;
use App\Repository\Repository;

class ProductRepository extends Repository implements IProductRepository {
    public function get_model(){
        return \App\Models\Product::class;
    }
}
