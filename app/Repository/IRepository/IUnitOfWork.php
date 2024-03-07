<?php
namespace App\Repository\IRepository;

interface IUnitOfWork {
    public function category(): ICategoryRepository;
    public function product(): IProductRepository;
    public function role(): IRoleRepository;
    public function company(): ICompanyRepository;
}
