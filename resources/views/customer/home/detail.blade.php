@extends('shared/_layout')

@section('content')
<form action="/customer/cart/addToCart" method="post">
    @csrf
    <input hidden name="id" value={{$product->id}} />
    {{-- <input hidden asp-for="Id" /> --}}
    <div class="card shadow border-0 mt-4 mb-4">
        <div class="card-header bg-secondary bg-gradient text-light py-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-white text-uppercase">{{$product->name}}</h3>
                    <p class="text-white-50 fw-semibold mb-0">by{{$product->author}}</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="py-3">
                <div class="row">
                    <div class="col-6 col-md-2 offset-lg-1 pb-1">
                        <a href="/" class="btn btn-outline-primary bg-gradient mb-5 fw-semibold btn-sm text-uppercase">
                            <small>Back to home</small>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 offset-lg-1 text-center mb-3">
                            <img src="{{$product->image_url}}" class="card-img-top rounded w-100" />
                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1">

                        <div class="col-12 col-md-6 pb-4">
                            <span class="badge">{{$product->category->name}}</span>
                        </div>
                        <div class="row ps-2">
                            <h6 class="text-dark text-opacity-50 ">ISBN : {{$product->isbn}}</h6>
                        </div>
                        <div class="row ps-2">
                            <h6 class="text-dark text-opacity-50  pb-2">
                                List Price:
                                <span class="text-decoration-line-through">
                                    {{ number_format($product->list_price, 2) }}
                                </span>
                            </h6>
                        </div>
                        <div class="row text-center ps-2">
                            <div class="p-1 col-3 col-lg-2 bg-white border-bottom">
                                <div class="text-dark text-opacity-50 fw-semibold">Quantity</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white border-bottom">
                                <div class="text-dark text-opacity-50 fw-semibold">1-50</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white border-bottom">
                                <div class="text-dark text-opacity-50 fw-semibold">51-100</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white border-bottom">
                                <div class="text-dark text-opacity-50 fw-semibold">100+</div>
                            </div>
                        </div>
                        <div class="row text-center ps-2">
                            <div class="p-1 col-3 col-lg-2 bg-white text-warning fw-bold">
                                <div>Price</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white text-warning fw-bold">
                                <div> {{ number_format($product->price, 2) }}</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white text-warning fw-bold">
                                <div> {{ number_format($product->price50, 2) }}</div>
                            </div>
                            <div class="p-1 col-3 col-lg-2 bg-white text-warning fw-bold">
                                <div> {{ number_format($product->price100, 2) }}</div>
                            </div>
                        </div>
                        <div class="row pl-2 my-3">
                            <p class="text-secondary lh-sm">{!!$product->description!!}</p>
                        </div>
                        <div class="row pl-2 mb-3">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary text-white border-0 fw-semibold"
                                          id="inputGroup-sizing-default">
                                        Count
                                    </span>
                                    <input name="count" type="number" value="1" class="form-control text-end"
                                           aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 pb-1">
                                <button type="submit"
                                        class="btn btn-primary bg-gradient  w-100 py-2 text-uppercase fw-semibold">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection