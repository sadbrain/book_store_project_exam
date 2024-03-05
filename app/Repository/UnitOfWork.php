<?php
namespace App\Repository;

use App\Repository\IRepository\IUnitOfWork;
use App\Repository\IRepository\ICategoryRepository;
use App\Repository\CategoryRepository;
use App\Repository\IRepository\IProductRepository;
use App\Repository\ProductRepository;
class UnitOfWork implements IUnitOfWork{
    private ICategoryRepository $category;
    private IProductRepository $product;
    public function category(): ICategoryRepository
    {
        return $this->category;
    }
    public function product(): IProductRepository
    {
        return $this->product;
    }
    public function __construct(){
        $this -> category = new CategoryRepository();
        $this -> product = new ProductRepository();
    }
}
