<?php
namespace App\Repository;

use App\Repository\IRepository\IOrderRepository;
use App\Repository\Repository;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class OrderRepository extends Repository implements IOrderRepository {
    public function get_model(){
        return \App\Models\Order::class;
    }
    public function update_status(int $id, ?string $order_status, ?string $payment_status = null ){
         $orderFromDb = $this->_model->find($id);
         if($orderFromDb != null){
            $orderFromDb ->  order_status = $order_status;
            if(filled($payment_status)){
                $orderFromDb -> payment_status = $payment_status;
            }
            $orderFromDb->save();
         }
    }
    
    public function update_stripe_payment_id(int $id, string $session_id, ?string $payment_intent_id) {
        $orderFromDb = $this->_model->find($id);
        if($orderFromDb != null){
            if(filled($session_id)){
                $orderFromDb -> session_id = $session_id;
            }
            if(filled($payment_intent_id )){
                $orderFromDb -> payment_intent_id = $payment_intent_id;
                $orderFromDb -> payment_date = Carbon::now();

    
            }
            $orderFromDb -> save();
        }
    }
}
