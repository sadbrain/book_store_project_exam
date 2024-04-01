@extends("shared/_layout")
@section('content')
<form method="post" action="{{ route('/cart/add', ['id' => $product->id]) }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">.
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
                            <div class="col-6 col-md-2 offset-lg-1 pb-1">
                                <a href="" class="btn btn-outline-primary bg-gradient mb-5 fw-semibold btn-sm text-uppercase">
                                    <small>Back to home</small>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-1">
                                <div class="col-12 col-md-6 pb-4">
                                    <span class="badge fs-2">Price: {{$product->price}}</span>
                                </div>
                                <div class="row ps-2">
                                    <h6 class="text-dark text-opacity-50 pb-2">
                                        List Price:
                                        <span class="text-decoration-line-through fs-2">
                                            {{$product->list_price}}
                                        </span>
                                    </h6>
                                </div>
                                <div class="row">
                                    <h3 class="text-dark"> ISBN: {{$product->isbn}}</h3>
                                </div>
                                <div class="row ">
                                    <h6 class="text-dark  ">{{$product->description}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >Add to cart</button>
            </div>
           
        </div>
    </div>
    
</form>
@endsection