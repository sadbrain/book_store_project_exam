<?php
namespace App\Repository;

use App\Repository\IRepository\IOrderDetailRepository;
use App\Repository\Repository;

class OrderDetailRepository extends Repository implements IOrderDetailRepository {
    public function get_model(){
        return \App\Models\OrderDetail::class;
    }
}
