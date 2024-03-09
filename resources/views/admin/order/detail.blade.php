@extends("shared/_layout")
@section('content')
<?php
$roles = config("constants.role");
$payment_status = config("constants.payment_status");
$order_status = config("constants.order_status");
$user_role = Auth::user()->role->name;
?>
<form method="post" class="my-5" id="orderForm">
    @csrf
    <input type="hidden" name="order[id]" value="{{$order->id}}"> 
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-light ml-0">
                <div class="container row">
                    <div class="col-12 d-none d-md-block col-md-6 pb-1">
                        <i class="fas fa-shopping-cart"></i> &nbsp; Order Summary
                    </div>
                    <div class="col-12 col-md-4 offset-md-2 text-right">
                        <a href="/admin/order" class="btn btn-outline-info form-control btn-sm">Back to Orders</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container rounded p-2">
                    <div class="row">
                        <div class="col-12 col-lg-6 pb-4">
                            <div class="row">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-primary">PickUp Details:</span>
                                </h4>
                            </div>
                            <div class="row my-1">
                                <div class="col-3">Name</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input value="{{$order->name}}" name="order[name]" type="text" class="form-control" />
                                    @else
                                        <input value="{{$order->name}}" name="order[name]"readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>
                            <div class="row my-1">
                                <div class="col-3">Phone</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input value="{{$order->phone}}" name="order[phone]" type="text" class="form-control" />
                                    @else
                                        <input value="{{$order->phone}}" name="order[phone]"readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>
                            <div class="row my-1">
                                <div class="col-3">Street Address</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input value="{{$order->street_address}}" name="order[street_address]" type="text" class="form-control" />
                                    @else
                                        <input value="{{$order->street_address}}" name="order[street_address]"readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>
                            <div class="row my-1">
                                <div class="col-3">Distreet Address</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input value="{{$order->district_address}}" name="order[district_address]" type="text" class="form-control" />
                                    @else
                                        <input value="{{$order->district_address}}" name="order[district_address]"readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">City</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input value="{{$order->city}}" name="order[city]" type="text" class="form-control" />
                                    @else
                                        <input value="{{$order->city}}" name="order[city]" readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">Email</div>
                                <div class="col-9">
                                    <input value="{{$order->user->email}}"  readonly type="text" class="form-control" />
                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">Order Date</div>
                                <div class="col-9">
                                    <input name="order[order_date]" readonly value="{{ $order->order_date }}" type="text" class="form-control" />

                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">Carrier</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input id="carrier" value="{{$order->carrier}}" name="order[carrier]" type="text" class="form-control" />
                                    @else
                                        <input  id="carrier" value="{{$order->carrier}}" name="order[carrier]" readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">Tracking Number</div>
                                <div class="col-9">
                                    @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                        <input id="trackingNumber" value="{{$order->tracking_number}}" name="order[tracking_number]" type="text" class="form-control" />
                                    @else
                                        <input id="trackingNumber"  value="{{$order->tracking_number}}" name="order[tracking_number]" readonly type="text" class="form-control" />
                                    @endif
                                </div>

                            </div>

                            <div class="row my-1">
                                <div class="col-3">Shipping Date</div>
                                <div class="col-9">
                                    <input name="order[shipping_date]" readonly value="{{ $order->shipping_date }}" type="text" class="form-control" />

                                </div>

                            </div>
                            @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                <div class="row my-1">
                                    <div class="col-3">Session ID</div>
                                    <div class="col-9">
                                            <input value="{{$order->session_id}}" name="order[session_id]" readonly type="text" class="form-control" />
                                    </div>

                                </div>

                                <div class="row my-1">
                                    <div class="col-3">Payment Intent ID</div>
                                    <div class="col-9">
                                            <input value="{{$order->payment_intent_id}}" name="order[payment_intent_id]" readonly type="text" class="form-control" />
                                    </div>

                                </div>
                            @endif

                            @if ($order->session_id == null)
                                <div class="row my-1">
                                    <div class="col-3">Payment Due Date</div>
                                    <div class="col-9">
                                            <input value="{{$order->payment_due_date}}" name="order[payment_due_date]" readonly type="text" class="form-control" />
                                    </div>

                                </div>
                            @else
                                <div class="row my-1">
                                    <div class="col-3">Payment Date</div>
                                    <div class="col-9">
                                            <input value="{{$order->payment_date}}" name="order[payment_date]" readonly type="text" class="form-control" />
                                    </div>

                                </div>
                            @endif

                            <div class="row my-1">
                                <div class="col-3">Payment Status</div>
                                <div class="col-9">
                                    <input name="order[payment_status]" readonly value="{{ $order->payment_status }}" type="text" class="form-control" />
                                </div>

                            </div>

                            @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                <button type="submit"   onclick="updateOrderDetails()" class="btn btn-warning form-control my-1">Update Order Details</button>
                            @endif

                        </div>

                        <div class="col-12 col-lg-5 offset-lg-1">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Order Summary</span>
                            </h4>

                            <label class="btn btn-outline-primary form-control my-2">Order Status - {{$order->order_status}}</label>

                            <ul class="list-group mb-3">
                                @foreach($order_details as $detail)
                                    <li class="list-group-item d-flex justify-content-between p-2">
                                        <div class="row container">
                                            <div class="col-8">

                                                <h6 class="my-0 text-primary">{{$detail->product->name}}</h6>
                                                <small class="text-muted">Price : {{ "$".number_format($detail->price,2) }}</small><br />
                                                <small class="text-muted">Quantity : {{$detail->quantity}}</small>
                                            </div>
                                            <div class="col-4 text-end">
                                                <p class="text-success">{{  "$".number_format($detail->quantity * $detail->price,2) }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="list-group-item bg-primary">
                                    <div class="row container">
                                        <div class="col-6">
                                            <h5 class="text-white">TOTAL {{ "$".number_format($order->order_total,2) }}</h5>
                                        </div>
                                        <div class="col-6 text-end">
                                            <h5 class="text-white"></h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>   

                            @if($order->payment_status == $payment_status["delayed_payment"] && $order->order_status == $order_status["shipped"])
                                <button type="submit"  onclick="payNow()" class="btn btn-success form-control my-1">Pay Now</button>
                            @endif


                            @if ($user_role == $roles["user_admin"] || $user_role == $roles["user_employee"])
                                @if($order->order_status == $order_status["approved"])
                                     <button type="submit" onclick="startProcessing()" class="btn btn-primary form-control my-1"> Start Processing</button>
                                 @endif

                                 @if($order->order_status == $order_status["in_process"])
                                 <button type="submit" onclick="validateAndShipOrder()" action="/admin/order/shipOrder" class="btn btn-primary form-control my-1"> Ship Order</button>
                                @endif

                            @endif

                            @if($order->order_status != $order_status["refunded"] && $order->order_status != $order_status["cancelled"] && $order->order_status != $order_status["shipped"])
                                <button onclick="cancelOrder()" type="submit" class="btn btn-danger form-control my-1">Cancel Order</button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
    </div>
</form>
@section('content-scripts')
<script>
        function updateOrderDetails() {
        document.getElementById("orderForm").action = "/admin/order/detail";
        document.getElementById("orderForm").submit();
    }

    function payNow() {
        document.getElementById("orderForm").action = "/admin/order/paynow";
        document.getElementById("orderForm").submit();
    }

    function startProcessing() {
        document.getElementById("orderForm").action = "/admin/order/startProcessing";
        document.getElementById("orderForm").submit();
    }

    function validateAndShipOrder() {
        if (validateInput()) {
            document.getElementById("orderForm").action = "/admin/order/shipOrder";
            document.getElementById("orderForm").submit();
        }
    }

    function cancelOrder() {
        document.getElementById("orderForm").action = "/admin/order/cancelOrder";
        document.getElementById("orderForm").submit();
    }

    function validateInput() {
        if (document.getElementById("trackingNumber").value == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter tracking number!',
            });
            return false;
        }
        if (document.getElementById("carrier").value == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter carrier!',
            });
            return false;
        }
        // ... (kiểm tra thêm các trường khác nếu cần)
        return true;
    }
</script>
@endsection
@endsection