<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repository\IRepository\IUnitOfWork;
use App\Repository\UnitOfWork;

class CustomerController extends Controller
{
    protected IUnitOfWork $_unitOfWork;
    public function __construct(UnitOfWork $unitOfWork) {
        $this -> _unitOfWork = $unitOfWork;
    }
}
