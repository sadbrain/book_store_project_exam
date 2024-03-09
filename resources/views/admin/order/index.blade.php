@extends("shared/_layout")
@section('content')
<?php
$pending = "text-primary";
$inprocess = "text-primary";
$completed = "text-primary";
$approved = "text-primary";
$all = "text-primary";
switch ($status)
    {
        case "pending":
            $pending = "active text-white bg-primary";
            break;
        case "inprocess":
            $inprocess = "active text-white bg-primary";
            break;
        case "completed":
            $completed = "active text-white bg-primary";
            break;
        case "approved":
            $approved = "active text-white bg-primary";
            break;
        default:
            $all = "active text-white bg-primary";
            break;

    }
?>
<div class="card shadow border-0 my-4">
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white py-2">Order List</h2>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <div class="d-flex justify-content-between pb-5 pt-2">
            <span></span>
            <ul class="list-group list-group-horizontal-sm">
                <a style="text-decoration:none;" href="/admin/order?status=inprocess">
                <li class="list-group-item {{$inprocess}}">In Process</li>
                </a>
                <a style="text-decoration:none;" href="/admin/order?status=pending">
                <li class="list-group-item {{$pending}}">Payment Pending</li>
                </a>
                <a style="text-decoration:none;" href="/admin/order?status=completed">
                <li class="list-group-item {{$completed}}">Completed</li>
                </a>
                <a style="text-decoration:none;" href="/admin/order?status=approved">
                <li class="list-group-item {{$approved}}">Approved</li>
                </a>
                <a style="text-decoration:none;" href="/admin/order?status=all">
                <li class="list-group-item {{$all}}">All</li>
                </a>
            </ul>
        </div>
        <table id="tblData" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>
                        {{$order->id}}
                    </td>
                    <td>
                        {{$order->name}}
                    </td>
                    <td>
                        {{$order->phone}}
                    </td>
                    <td>
                        {{$order->user->email}}
                    </td>
                    <td>
                        {{$order->order_status}}
                    </td>
                    <td>
                        {{$order->order_total}}
                    </td>
                    <td>
                        <div class="w-75 btn-group" role="group">
                            <a href="/admin/order/detail/{{$order['id']}}" class="btn btn-primary mx-4">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>   
    </div>

    
</div>
@endsection