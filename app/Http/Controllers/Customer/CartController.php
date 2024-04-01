<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\CustomerController;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Http\Controllers\Customer\DB;

class CartController extends CustomerController
{
    public function summary()
    {
        $user = Auth::user();
        $order = new \App\Models\Order();

        $shopping_carts = $this->_unitOfWork->cart()->get_all("user_id =" . $user->id);
        foreach ($shopping_carts as $cart) {
            $cart->price = $this->get_price_based_on_quanity($cart);
            $order->order_total += $cart->price * $cart->count;
        }
        $order->name = $user->name;
        $order->phone = $user->phone;
        $order->street_address = $user->street_address;
        $order->district_address = $user->district_address;
        $order->city = $user->city;

        return view("customer/cart/summary", compact('order', 'shopping_carts'));
    }
    public function summaryPost(Request $request)
    {
        $user = Auth::user();
        $order = new \App\Models\Order();

        $order_data = $request->input("order");
        $order->fill($order_data);
        $order->user_id = $user->id;
        $order->order_date = now();

        $shopping_carts = $this->_unitOfWork->cart()->get_all("user_id =" . $user->id);
        foreach ($shopping_carts as $cart) {
            $cart->price = $this->get_price_based_on_quanity($cart);
            $order->order_total += $cart->price * $cart->count;
        }

        $order_status = config('constants.order_status');
        $payment_status = config('constants.payment_status');
        //custoemr is company account
        if ($user->company_id != null) {
            $order->order_status = $order_status["approved"];
            $order->payment_status = $payment_status["delayed_payment"];
        }
        //custoemr is normal account
        else {
            $order->order_status = $order_status["pending"];
            $order->payment_status = $payment_status["pending"];
        }
        $order = $this->_unitOfWork->order()->add($order);

        foreach ($shopping_carts as $cart) {
            $order_detail = [
                "quantity" => $cart->count,
                "product_id" => $cart->product_id,
                "price" => $cart->price,
                "order_id" => $order->id
            ];
            $this->_unitOfWork->order_detail()->add($order_detail);
        }

        if ($user->company_id == null) {
            $domain = $request->getSchemeAndHttpHost();
            Stripe::setApiKey(config('stripe.sk'));

            $lineItems = [];
            foreach ($shopping_carts as $cart) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $cart->product->name,
                        ],
                        'unit_amount' => (int)($cart->price * 100), // $20.50 => 2050
                    ],
                    'quantity' => $cart->count,
                ];
            }
            $session = Session::create([
                'success_url' => $domain . "/customer/cart/orderConfirmation/$order->id",
                'cancel_url' => $domain . "/customer/cart/index",
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
            ]);

            $this->_unitOfWork->order()->update_stripe_payment_id($order->id, $session->id, $session->payment_intent);
            return redirect()->away($session->url, 303);
        }
        return redirect("/customer/cart/orderConfirmation/{$order->id}");
    }
    public function orderConfirmation(int $id)
    {
        $order_status = config('constants.order_status');
        $payment_status = config('constants.payment_status');
        $order = $this->_unitOfWork->order()->get("id = $id");
        if ($order->payment_status !== $payment_status["delayed_payment"]) {
            // Place an order by customer
            Stripe::setApiKey(config('stripe.sk'));
            $session = Session::retrieve($order->session_id);
            if (strtolower($session->payment_status) == 'paid') {
                $this->_unitOfWork->order()->update_status($order->id, $order_status["approved"], $payment_status["approved"]);
                $this->_unitOfWork->order()->update_stripe_payment_id($order->id, $session->id, $session->payment_intent);
            }
        }

        return view("customer/cart/orderConfirmation", compact("id"));
    }
    protected function get_price_based_on_quanity($cart)
    {
        if ($cart->count <= 50) {
            return $cart->product->price;
        } else if ($cart->count <= 100) {
            return $cart->product->price50;
        } else {
            return $cart->product->price100;
        }
    }

    public function showItemIntoCart()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $products = $this->_unitOfWork->cart()->get_all("user_id =" . $user_id);
        return response()->json(['data' => $products]);
    }
    public function getAllFromCart()
    {
        return view("customer/cart/list-cart");
    }

    public function addToCart(Request $request)
    {
        $users = Auth::user();
        $user_id = $users->id;
        $product_id = $request->input('product_id');
        $count = $request->count;
        $price = $request->price;
        $cart = ShoppingCart::where(['user_id' => $user_id, 'product_id' => $product_id])
            ->where('product_id', $product_id)
            ->first();
        if ($cart) {
            //San pham da ton tai
            $cart->count = $count;
            $cart->save();
        } else {
            //San pham chua ton tai
            $cart = new ShoppingCart();
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->count = $count;
            $cart->price = $price;
            $cart->save();
            $cart->price = $this->get_price_based_on_quanity($cart);
            $cart->save();
        }

        return back()->with('msg', 'Add to cart thanh cong');
    }

    public function getProductById($id = null)
    {
        $product = $this->_unitOfWork->product()->get("id = $id");

        return response()->json(['data' => $product]);
    }

    public function plus($id)
    {
        $cart = $this->_unitOfWork->cart()->get("id = $id");
        if ($cart) {
            $cart->count += 1;
            $cart->save();
            $cart->price = $cart->count * $cart->product->price;
            $cart->save(); // Lưu giá mới vào cơ sở dữ liệu
            return response()->json(['data' => ['count' => $cart->count, 'price' => $cart->price]], 200);
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function minus($id)
    {
        $cart = $this->_unitOfWork->cart()->get("id = $id");
        if ($cart) {
            $cart->count -= 1;
            $cart->save();
            $cart->price = $cart->count * $cart->product->price;
            $cart->save(); // Lưu giá mới vào cơ sở dữ liệu
            return response()->json(['data' => ['count' => $cart->count, 'price' => $cart->price]], 200);
        } else {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    }

    public function deleteFromCart($id)
    {
        $cart = $this->_unitOfWork->cart()->get("id = $id");
        if ($cart) {
            $cart->delete();
        }
        return view('customer/cart/list-cart')->with('msg', 'Delete successfull');
    }
}
