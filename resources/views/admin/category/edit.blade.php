@extends("shared/_layout")
@section('content')

<div class="card shadow border-0 my-5">
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white py-2">Update Category</h1>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <form method="post" action="/api/admin/categories/{{$category->id}}" class="row" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="border p-3">
                        <input hidden value="{{$category->id}}" name="id" class="form-control border-0 shadow" />
                        <div class="form-floating col-12 py-2">
                            <input value="{{$category->name}}" name="name" class="form-control border-0 shadow" />
                            <label class="ms-2">Name</label>
                        </div>

                        <div class="form-floating col-12 py-2">
                            <textarea value="{{$category->slug}}" name="slug" class="form-control border-0 shadow">{{$category->slug}}</textarea>
                            <label class="ms-2 text-muted">Slug</label>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6 col-md-3">
                                <button type="submit" class="btn btn-primary form-control">
                                    update
                                </button>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="/admin/category" class="btn btn-outline-primary form-control">
                                    Back To List
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('content-scripts')
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons  lists   table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |  align lineheight | numlist bullist indent outdent',
    });
</script>
@endsection