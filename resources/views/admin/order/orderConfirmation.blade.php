@extends("shared/_layout")
@section('content')
<div class="container row pt-4" class="my-5">
    <div class="col-12 text-center">
        <h1 class="text-primary text-center">Order Placed Successfully!</h1>
        Your Order Number is : {{$id}} <br/><br/>
        <img src="/images/product/left.jpg" width="65%" />
    </div>
    <div class="col-12 text-center" style="color:maroon">
        <br/>
        Your order has been placed successfully! <br/>
    </div>

</div> 
@endsection