@extends("shared/_layout")
@section('content')
<div class="card shadow border-0 mt-4">
    <div class="card-header bg-secondary bg-gradient ml-0 py-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white py-2">Product List</h1>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <div class="container">
            <div class="row pb-4">
                <div class="col-6">
                </div>
                <div class="col-6 text-primary text-end">
                    <a href="/admin/product/create" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        Create New Product
                    </a>
                </div>
            </div>

            <table class="table table-bordered table-striped" id="tblData">
                <thead>
                    <tr>
                        <th>
                        Title
                        </th>
                        <th>
                        ISBN
                        </th>
                        <th>
                        Price
                        </th>
                        <th>
                        Author
                        </th>
                        <th>
                        Category
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>
@section('content-scripts')
<script>
var dataTable;

$(document).ready(function () {
    loadDataTable();
});

function loadDataTable() {
    dataTable = $('#tblData').DataTable({
        "ajax": { url: '/admin/product/getAll' },
        "columns": [
            { data: 'name', "width": "25%" },
            { data: 'isbn', "width": "15%" },
            { data: 'list_price', "width": "10%" },
            { data: 'author', "width": "15%" },
            { data: 'category.name', "width": "10%" },
            {
                data: 'id',
                "render": function (data) {
                    return `<div class="w-75 btn-group" role="group">
                     <a href="/admin/product/update/${data}" class="btn btn-primary mx-2"> <i class="bi bi-pencil-square"></i> Edit</a>               
                     <a onClick=Delete('/admin/product/delete/${data}') class="btn btn-danger mx-2"> <i class="bi bi-trash-fill"></i> Delete</a>
                    </div>`
                },
                "width": "25%"
            }
        ]
    });
}

function Delete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                method: 'POST',
                type: 'DELETE',
                data: {_token: "{{ csrf_token() }}"},
                success: function (data) {
                    dataTable.ajax.reload();
                    toastr.success(data.message);
                }
            })
        }
    })
}
</script>
@endsection
@endsection