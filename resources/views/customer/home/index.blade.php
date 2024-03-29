@extends('shared/_layout')

@section('content')
<div class="row pb-3 my-5">
    @foreach ($products as $product)
        <div class="col-lg-3 col-sm-6">
            <div class="row p-2">
                <div class="col-12 p-1">
                    <div class="card border-0 p-3 shadow  border-top border-5 rounded">
                        @if($product -> image_url != null)
                            <img src="{{$product -> image_url}}" class="card-img-top rounded" />
                        @else
                            <img src="https://placehold.co/500x600/png" class="card-img-top rounded" />
                        @endif
                        <div class="card-body pb-0">
                            <div class="pl-1">
                                <p class="card-title h5 text-dark opacity-75 text-uppercase text-center">{{$product->name}}</p>
                                <p class="card-title text-warning text-center">by <b>{{$product->author}}</b></p>
                            </div>
                            <div class="pl-1">
                                <p class="text-dark text-opacity-75 text-center mb-0">
                                    List Price:
                                    <span class="text-decoration-line-through">
                                        {{ number_format($product->list_price, 2) }}
                                    </span>
                                </p>
                            </div>
                            <div class="pl-1">
                                <p class="text-dark text-opacity-75 text-center">
                                    As low as:
                                    <span>
                                        {{ number_format($product->price100, 2) }}

                                    </span>
                                </p>
                            </div>
                        </div>
                        <div>
                            <a href="/cust/detail/{{$product->id}}"
                               class="btn btn-primary bg-gradient border-0 form-control">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
