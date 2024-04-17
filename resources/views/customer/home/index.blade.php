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
                    <div class="row">
                        <div class="col-md-9">
                            <!-- Phần chi tiết sản phẩm -->
                            <a href="/customer/detail/{{$product->id}}" class="btn btn-primary bg-gradient border-0 form-control">
                                Details
                            </a>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route("addFavoriteItem", ['id' => $product->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="heart-icon fa fa-heart" style="font-size:24px; color: blue;"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endsection

    @section('content-scripts')
    <script>
        var heartIcons = document.querySelectorAll(".heart-icon");

        heartIcons.forEach(function(heartIcon) {
            heartIcon.addEventListener("click", function() {
                var currentColor = this.style.color;

                if (currentColor === "blue" || currentColor === "") {
                    this.style.color = "red";
                } else {
                    this.style.color = "blue";
                }
            });
        });
    </script>

    @endsection