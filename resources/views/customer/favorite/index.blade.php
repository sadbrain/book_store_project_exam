@extends('shared/_layout')


@section('content')
@foreach ($favorites as $favorite)
<div class="card card-sm mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <!-- Hiển thị hình ảnh của sản phẩm -->
            <img src="{{ $favorite->image_url }}" class="img-fluid img-thumbnail" alt="{{ $favorite->name }}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $favorite->name }}</h5>
                <p class="card-text">{{ $favorite->slug }}</p>
                <p class="card-text">{{ $favorite->description }}</p>
                <p class="card-text">${{ $favorite->price }}</p>
                <!-- Thêm nút chi tiết sản phẩm -->
                <a href="/customer/detail/{{$favorite->id}}" class="btn btn-primary bg-gradient border-0">
                    Detail
                </a>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection