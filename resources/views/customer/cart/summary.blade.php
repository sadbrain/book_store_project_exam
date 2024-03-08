@extends("shared/_layout")
@section('content')
<form method="post" action="/customer/cart/summary" class="my-5">
    @csrf
	<br />
	<div class="container">
		<div class="card shadow border-0">

			<div class="card-header bg-secondary bg-gradient text-light ml-0 py-4">
				<div class="row px-4">
					<div class="col-6">
						<h5 class="pt-2 text-white">
							Order Summary
						</h5>
					</div>
					<div class="col-6 text-end">
						<a href="/customer/cart" class="btn btn-outline-danger btn-sm">Back to Cart</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="container rounded p-2">
					<div class="row">
						<div class="col-12 col-lg-6 pb-4">
							<div class="row">
								<h4 class="d-flex justify-content-between align-items-center mb-3">
									<span class="text-info">Shipping Details:</span>
								</h4>
							</div>
							<div class="row my-1">
								<div class="col-3">
									<label>Name</label>
								</div>
								<div class="col-9">
									<input name="order[name]" value = "{{$order->name}}" class="form-control" />
								</div>
							</div>
							<div class="row my-1">
								<div class="col-3">
									<label>Phone</label>
								</div>
								<div class="col-9">
                                    <input name="order[phone]" value ="{{$order->phone}}" class="form-control" />
								</div>
							</div>
							<div class="row my-1">
								<div class="col-3">
									<label>Street Address</label>
								</div>
								<div class="col-9">
                                    <input name="order[street_address]" value = "{{$order->street_address}}" class="form-control" />
								</div>
							</div>
							<div class="row my-1">
								<div class="col-3">
									<label>District Address</label>
								</div>
								<div class="col-9">
                                    <input name="order[district_address]" value = "{{$order->district_address}}" class="form-control" />
								</div>
							</div>
							<div class="row my-1">
								<div class="col-3">
									<label>City</label>
								</div>
								<div class="col-9">
                                    <input name="order[city]" value = "{{$order->city}}" class="form-control" />
								</div>
							</div>
							
						</div>
						<div class="col-12 col-lg-5 offset-lg-1">
							<h4 class="d-flex justify-content-between align-items-center mb-3">
								<span class="text-info">Order Summary:</span>
							</h4>
							<ul class="list-group mb-3">
								@foreach ($shopping_carts as $detail)
								
									<li class="list-group-item d-flex justify-content-between">
										<div>
											<h6 class="my-0">{{$detail->Product->name}}</h6>
											<small class="text-muted">Quantity: {{$detail->count}}</small>
										</div>
                                       
										<span class="text-muted">{{ number_format($detail->price * $detail->count,2)}} </span>
									</li>
								@endforeach

								<li class="list-group-item d-flex justify-content-between bg-light">
									<small class="text-info">Total (USD)</small>
									<strong class="text-info">{{ number_format($order->order_total,2)}}</strong>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12 col-md-8 pt-2">
						<p style="color:maroon; font-size:14px;">
							Estimate Arrival Date:
							{{now()->addDays(7)->toDateString()}} - {{now()->subDays(14)->toDateString()}}
						</p>
					</div>
					<div class="col-12 col-md-4">
						<button type="submit" value="Place Order" class="btn btn-primary form-control">Place Order</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection