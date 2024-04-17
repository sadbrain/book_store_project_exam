@extends('shared/_layout')
@section('content')
<div>
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white py-2">Favorite</h1>
            </div>
        </div>
    </div>
    @foreach ($favorites as $favorite)
    <div class="card card-sm mb-3">
        <div class="row">
            <div class="col-md-3">
                <!-- Hiển thị hình ảnh của sản phẩm -->
                <img src="{{ $favorite->image_url }}" class="img-fluid img-thumbnail" alt="{{ $favorite->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><b>Name:</b> {{ $favorite->name }}</h5>
                    <p class="card-text"><b>Slug:</b> {{ $favorite->slug }}</p>
                    <p class="card-text"><b>Author:</b> {{ $favorite->author }}</p>
                    <p class="card-text"><b>Price:</b> ${{ $favorite->price }}</p>
                    <p class="card-text"><b>Description:</b> {!! $favorite->description !!}</p>
                    <!-- Thêm nút chi tiết sản phẩm -->
                    <a href="/customer/detail/{{$favorite->id}}" class="btn btn-primary bg-gradient border-0">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>




@endsection