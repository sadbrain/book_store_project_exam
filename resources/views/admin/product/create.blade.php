@extends("shared/_layout")
@section('content')
<div class="card shadow border-0 my-5">
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white py-2">Create Product</h1>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <form method="post" action="/admin/product/create" class="row" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-10">
                    <div class="border p-3">

                        <div class="form-floating col-12 py-2">
                            <input name="name" class="form-control border-0 shadow" />
                            <label  class="ms-2">Name</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input name="description" class="form-control border-0 shadow" />
                            <label  class="ms-2">Description</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input name="isbn" class="form-control border-0 shadow" />
                            <label  class="ms-2">ISBN</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input name="author" class="form-control border-0 shadow" />
                            <label  class="ms-2">Author</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input type="number" name="list_price" class="form-control border-0 shadow" />
                            <label  class="ms-2">List price</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <input type="number" name="price" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price</label>
                        </div>

                        
                        <div class="form-floating col-12 py-2">
                            <input type="number" name="price50" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price50</label>
                        </div>
                        
                        <div class="form-floating col-12 py-2">
                            <input type="number" name="price100" class="form-control border-0 shadow" />
                            <label  class="ms-2">Price100</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <select name="category_id" class="form-select border-0 shadow" >
                                <option disabled selected>--Select Category--</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
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
                                   Create
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
                    
                </div>

            </div>
        </form>   
    </div>
</div>  

@endsection