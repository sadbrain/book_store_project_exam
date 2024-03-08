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
use App\Repository\IRepository\ICartRepository;
use App\Repository\CartRepository;
use App\Repository\IRepository\IUserRepository;
use App\Repository\UserRepository;
use App\Repository\IRepository\IOrderRepository;
use App\Repository\OrderRepository;
use App\Repository\IRepository\IOrderDetailRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\IRepository\IPaymentRepository;
use App\Repository\PaymentRepository;

class UnitOfWork implements IUnitOfWork{
    private ICategoryRepository $category;
    private IProductRepository $product;
    private IRoleRepository $role;
    private ICompanyRepository $company;
    private ICartRepository $cart;
    private IUserRepository $user;
    private IOrderRepository $order;
    private IOrderDetailRepository $order_detail;
    private IPaymentRepository $payment;

    public function __construct(){
        $this -> category = new CategoryRepository();
        $this -> product = new ProductRepository();
        $this -> role = new RoleRepository();
        $this -> company = new CompanyRepository();
        $this -> cart = new CartRepository();
        $this -> user = new UserRepository();
        $this -> order = new OrderRepository();
        $this -> order_detail = new OrderDetailRepository();
        $this -> payment = new PaymentRepository();
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
    public function cart(): ICartRepository
    {
        return $this->cart;
    }
    public function user(): IUserRepository
    {
        return $this->user;
    }
    public function order(): IOrderRepository
    {
        return $this->order;
    }
    public function order_detail(): IOrderDetailRepository
    {
        return $this->order_detail;
    }
    public function payment(): IPaymentRepository
    {
        return $this->payment;
    }

}
