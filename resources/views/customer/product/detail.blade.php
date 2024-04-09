@extends("shared/_layout")
@section('content')
<form method="POST" action="{{ route('/cart/add', ['id' => $product->id])}}">
    @csrf
    <input type="hidden" name="cart[product_id]" value="{{ $product->id }}">.
    <div class="card shadow border-0 mt-4 mb-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{$product->image_url}}" alt="" class="w-100 h-100">
            </div>
            <div class="col-md-6">
                <div class="card-header bg-secondary bg-gradient text-light py-4">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="text-white text-uppercase">{{$product->name}}</h3>
                            <p class="text-white-50 fw-semibold mb-0">by {{$product->author}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="py-3">
                        <!-- Các thông tin khác về sản phẩm -->
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-1">
                                <div class="col-12 col-md-6 pb-4">
                                    <h4>Price: {{$product->price}}</h4>
                                    <input name="cart[price]" value="{{$product->price}}" type="hidden">
                                </div>
                                <div class="row ps-2">
                                    <h4 class="text-dark text-opacity-50 pb-2">
                                        List Price:
                                        <h4 class="text-decoration-line-through fs-2">
                                            {{$product->list_price}}
                                        </h4>
                                    </h4>
                                </div>
                                <div class="row ">
                                    <h4 class="text-dark"> ISBN: {{$product->isbn}}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-lg-5 col-xl-2">
                                        <div class="d-flex">
                                            <input min="1" name="cart[count]" type="number" class="form-control" style="width: 80px; height: 45px" placeholder="1" />
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-lg-7 col-xl-10">
                                        <div class="row">
                                            <h4 class="text-dark">{{$product->description}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-left">
                        <a href="/" class="btn btn-outline-primary bg-gradient mb-5 fw-semibold btn-sm text-uppercase">
                            Back to home
                        </a>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection