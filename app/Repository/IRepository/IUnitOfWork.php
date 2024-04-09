<?php
namespace App\Repository\IRepository;

interface IUnitOfWork {
        public function category(): ICategoryRepository;
        public function product(): IProductRepository;
        public function role(): IRoleRepository;
        public function company(): ICompanyRepository;
        public function cart(): ICartRepository;
        public function user(): IUserRepository;
        public function order(): IOrderRepository;
        public function order_detail(): IOrderDetailRepository;
        public function payment(): IPaymentRepository;
}
