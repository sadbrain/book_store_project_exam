@extends("shared/_layout")
@section('content')
<div class="card shadow border-0 my-5">
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white py-2">Update Product</h1>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <form method="post" action="/admin/product/update" class="row" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-10">
                    <div class="border p-3">
                        <input hidden value ="{{$product->id}}"name="id" class="form-control border-0 shadow" />
                        
                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->name}}" name="name" class="form-control border-0 shadow" />
                            <label  class="ms-2">Name</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->description}}" name="description" class="form-control border-0 shadow" />
                            <label  class="ms-2">Description</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->isbn}}" name="isbn" class="form-control border-0 shadow" />
                            <label  class="ms-2">ISBN</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input  value ="{{$product->author}}" name="author" class="form-control border-0 shadow" />
                            <label  class="ms-2">Author</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->list_price}}" type="number" name="list_price" class="form-control border-0 shadow" />
                            <label  class="ms-2">List price</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->price}}" type="number" name="price" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->price50}}" type="number" name="price50" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price50</label>
                        </div>
                        
                        <div class="form-floating col-12 py-2">
                            <input value ="{{$product->price100}}" type="number" name="price100" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price100</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <select name="category_id" class="form-select border-0 shadow" >
                                @foreach ($categories as $category)

                                    <option <?= $product->category->name == $category->name ? "selected" : null?> value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label  class="ms-2">Category</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input type="file" name="files" class="form-control border-0 shadow" />
                            <label class="ms-2">Product Image</label>
                        </div> 

                        <div class="row mt-3">
                            <div class="col-6 col-md-3">
                                <button type="submit" class="btn btn-primary form-control">
                                   update
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="/admin/product" class="btn btn-outline-primary form-control">
                                    Back To List
                                </a>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-2">
                    @if(filled($product->image_url))
                        <div class="border p-1 m-2 text-center">
                            <img src="{{$product->image_url}}" width="100%"
                                    style="border-radius:5px; border:1px solid #bbb9b9" />
                        </div>
                    @endif
                </div>

            </div>
        </form>   
    </div>
</div>  

@endsection