<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Refund;
use Stripe\RefundCreateOptions;
use Stripe\Stripe;


class OrderController extends AdminController
{  
   
    public function index(Request $request){
        $status = $request->query('status', 'all');
        $user = Auth::user();
        $roles = config("constants.role");
        $order_status = config("constants.order_status");
        $payment_status = config("constants.payment_status");
        if ($user->role->name == $roles["user_admin"] || $user->role->name == $roles["user_employee"]) {
            switch ($status) {
                case "pending":
                    $orders = $this->_unitOfWork->order()->get_all("payment_status = '{$payment_status['delayed_payment']}'");
                    break;
                case "inprocess":
                    $orders = $this->_unitOfWork->order()->get_all("order_status = '{$order_status['in_process']}'");
                    break;
                case "completed":
                    $orders = $this->_unitOfWork->order()->get_all("order_status = '{$order_status['shipped']}'");
                    break;
                case "approved":
                    $orders = $this->_unitOfWork->order()->get_all("order_status = '{$order_status['approved']}'");

                    break;
                default:
                    $orders = $this->_unitOfWork->order()->get_all();
                    break;
            }
        } else {
            switch ($status) {
                case "pending":
                    $orders = $this->_unitOfWork->order()->get_all("user_id = $user->id AND payment_status = '{$payment_status['delayed_payment']}'");
                    break;
                case "inprocess":
                    $orders = $this->_unitOfWork->order()->get_all("user_id = $user->id AND order_status = '{$order_status['in_process']}'");
                    break;
                case "completed":
                    $orders = $this->_unitOfWork->order()->get_all("user_id = $user->id AND order_status = '{$order_status['shipped']}'");
                    break;
                case "approved":
                    $orders = $this->_unitOfWork->order()->get_all("user_id = $user->id AND order_status = '{$order_status['approved']}'");
                    break;
                default:
                    $orders = $this->_unitOfWork->order()->get_all("user_id = $user->id");
                    break;
            }
        }
        
        return view("admin/order/index", compact("orders","status"));

    }

    public function detail(int $id){
        $order = $this->_unitOfWork->order()->get("id = $id");
        $order_details = $this->_unitOfWork->order_detail()->get_all("order_id = $id");

        return view('admin/order/detail', compact("order","order_details"));
    }

    public function detailPost(Request $request){
        $orderId = $request->input("order.id"); // Assuming the order ID is in the "id" field of the "order" input
        $order = $this->_unitOfWork->order()->get("id = $orderId");
    
        if (!$order) {
            abort(404, 'Order not found');
        }
    
        $order_data = $request->input("order");
        $order->fill($order_data);
        
        $this->_unitOfWork->order()->update($order);
    
        session()->flash("message.success","Order Details Updated Successfully.");
        return redirect("/admin/order/detail/$orderId");
    }
    public function startProcessing(Request $request){
        $orderId = $request->input("order.id"); // Assuming the order ID is in the "id" field of the "order" input
        $order = $this->_unitOfWork->order()->get("id = $orderId");
    
        if (!$order) {
            abort(404, 'Order not found');
        }

        $this->_unitOfWork->order()->update_status($orderId, config("constants.order_status.in_process"));
        session()->flash("message.success","Order Details Updated Successfully.");
        return redirect("/admin/order/detail/$orderId");

    }

    public function shipOrder(Request $request){
        $orderId = $request->input("order.id"); // Assuming the order ID is in the "id" field of the "order" input
        $order = $this->_unitOfWork->order()->get("id = $orderId");
    
        if (!$order) {
            abort(404, 'Order not found');
        }
        $order->carrier = $request->input("order.carrier");
        $order->order_status = config("constants.order_status.shipped");
        $order->tracking_number = $request->input("order.tracking_number");
        $order->shipping_date = now();
        if($order->payment_status == config("constants.payment_status.delayed_payment")){
            $order->payment_due_date = now()->addDays(30); 
        }
        $this->_unitOfWork->order()->update($order);

        session()->flash("message.success","Order Shipped Successfully.");
        return redirect("/admin/order/detail/$orderId");
    }
    public function paynow(Request $request){
        $orderId = $request->input("order.id"); // Assuming the order ID is in the "id" field of the "order" input
        $order = $this->_unitOfWork->order()->get("id = $orderId");
    
        if (!$order) {
            abort(404, 'Order not found');
        }
        $order_details = $this->_unitOfWork->order_detail()->get_all("order_id = $orderId");

        $domain = $request->getSchemeAndHttpHost();
        Stripe::setApiKey(config('stripe.sk'));

        $lineItems = [];
        foreach ($order_details as $detail){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $detail->product->name,
                    ],
                    'unit_amount' => (int)($detail->price * 100), // $20.50 => 2050
                ],
                'quantity' => $detail->quantity,
            ];
        }
        $session = Session::create([
            'success_url' => $domain . "/admin/order/orderConfirmation/$order->id",
            'cancel_url' => $domain . "/admin//order/detail/$order->id",
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
        ]);

        $this->_unitOfWork->order()->update_stripe_payment_id($order->id, $session->id , $session->payment_intent);
        return redirect()->away($session->url, 303);

    }

    public function orderConfirmation(int $id){
        $order_status = config('constants.order_status');
        $payment_status = config('constants.payment_status');
        $order = $this->_unitOfWork->order()->get("id = $id");
        if($order->payment_status == $payment_status["delayed_payment"])
        {
            // Place an order by customer
            Stripe::setApiKey(config('stripe.sk'));
            $session = Session::retrieve($order->session_id);
            if (strtolower($session->payment_status) == 'paid') {
                $this->_unitOfWork->order()->update_status($order->id, $order->order_status, $payment_status["approved"]);
                $this->_unitOfWork->order()->update_stripe_payment_id($order->id, $session->id , $session->payment_intent);
            }
        }

        return view("admin/order/orderConfirmation", compact("id"));
    }

    public function cancelOrder(Request $request){
        $order_status = config('constants.order_status');
        $payment_status = config('constants.payment_status');
        $orderId = $request->input("order.id"); // Assuming the order ID is in the "id" field of the "order" input
        $order = $this->_unitOfWork->order()->get("id = $orderId");
    
        if (!$order) {
            abort(404, 'Order not found');
        }
        if($order->payment_status == $payment_status["approved"]){
            Stripe::setApiKey(config('stripe.sk'));
            $options = [
                'reason' => "requested_by_customer",
                'payment_intent' => $order->payment_intent_id,
            ];
            $refund = Refund::create($options);
            $this->_unitOfWork->order()->update_status($order->id, $order_status["cancelled"], $order_status["refunded"]);

        }else{
            $this->_unitOfWork->order()->update_status($order->id, $order_status["cancelled"], $order_status["cancelled"]);
        }
        session()->flash("message.success","Order Cancelled Successfully.");
        return redirect("/admin/order/detail/$orderId");

    }
}
