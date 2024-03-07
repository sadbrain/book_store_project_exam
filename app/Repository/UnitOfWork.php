<?php
namespace App\Repository;

use App\Repository\IRepository\IUnitOfWork;
use App\Repository\IRepository\ICategoryRepository;
use App\Repository\CategoryRepository;
use App\Repository\IRepository\IProductRepository;
use App\Repository\ProductRepository;
use App\Repository\IRepository\IRoleRepository;
use App\Repository\RoleRepository;
use App\Repository\IRepository\ICompanyRepository;
use App\Repository\CompanyRepository;
class UnitOfWork implements IUnitOfWork{
    private ICategoryRepository $category;
    private IProductRepository $product;
    private IRoleRepository $role;
    private ICompanyRepository $company;

    public function __construct(){
        $this -> category = new CategoryRepository();
        $this -> product = new ProductRepository();
        $this -> role = new RoleRepository();
        $this -> company = new CompanyRepository();
    }

    public function category(): ICategoryRepository
    {
        return $this->category;
    }
    public function product(): IProductRepository
    {
        return $this->product;
    }
    public function role(): IRoleRepository
    {
        return $this->role;
    }
    public function company(): ICompanyRepository
    {
        return $this->company;
    }
}
