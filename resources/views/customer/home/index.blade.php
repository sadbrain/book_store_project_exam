@extends('shared/_layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card-header bg-secondary bg-gradient ml-0 py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="text-white py-2">Welcome</h1>
                    </div>
                </div>
            </div>
            <h2><i>"Discover the World Through Books"</i></h2>
            <p>Welcome to our online bookstore, where we provide you with a space to explore and uncover the world within the pages of each book. With a diverse and extensive collection, we are committed to delivering exceptional reading experiences.<br><br>

                From gripping novels and practical guidebooks to timeless literary works, we take pride in offering a library of books that caters to every interest and curiosity. Whether you seek thrilling adventures, new knowledge, or inspiration, we will help you discover the perfect works.<br><br>

                More than just a bookstore, we foster a community of book lovers, where you can share insights, receive reading recommendations, and connect with fellow enthusiasts. We believe that books have the power to transform lives, broaden perspectives, and open doors to extraordinary experiences.<br><br>

                Convenient, reliable, and accessible, our online bookstore is here to accompany you on your journey of knowledge and passion. Join us today and immerse yourself in a world of promising pages.<br><br>

                (Note: The translation provided may not be an exact word-for-word translation, but it captures the essence and meaning of the original text.)</p>
        </div>
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($products as $key => $product)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" @if($key===0) class="active" @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($products as $key => $product)
                    <div class="carousel-item @if($key === 0) active @endif">
                        <img class="d-block w-100 h-auto" src="{{$product->image_url}}" alt="Slide {{$key + 1}}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
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
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="heart-icon fa fa-heart" id="favoriteButton" style="font-size:24px; color: blue;"></i>
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

        // var productId = document.getElementById("product_id").value
        // document.addEventListener("DOMContentLoaded", function() {
        //     isProductInFavorite(productId);
        //     console.log(productId)
        // });

        // function isProductInFavorite(productId) {
        //     var productId = document.getElementById("product_id").value
        //     fetch(`http://127.0.0.1:8000/customer/favorite/list-favorite`)
        //         .then(response => {
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then(data => {
        //             // Kiểm tra xem productId có trong danh sách favorite không
        //             let isFavorite = false;
        //             for (let i = 0; i < data.length; i++) {
        //                 if (data[i][product_id] == productId) {
        //                     // Nếu sản phẩm tồn tại trong danh sách favorite, thay đổi màu của icon thành đỏ
        //                     isFavorite = true;
        //                     break;
        //                 }
        //             }
        //             if (isFavorite) {
        //                 document.getElementById("favoriteButton").innerHTML = '<i class="heart-icon fa fa-heart" style="font-size:24px; color: red;"></i>';
        //             } else {
        //                 document.getElementById("favoriteButton").innerHTML = '<i class="heart-icon fa fa-heart" style="font-size:24px; color: blue;"></i>';
        //             }

        //         })
        //         .catch(error => {
        //             console.error('There was a problem with the fetch operation:', error);
        //         });
        // }
    </script>

    @endsection 