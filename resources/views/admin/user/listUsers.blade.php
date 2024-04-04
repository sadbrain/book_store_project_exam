@extends("shared/_layout")

@section('content')
<table class="table table-dark">

    <head>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Role</th>
            <th scope="col">Company</th>
            <th scope="col">Lock</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </head>
    <tbody class="table">

    </tbody>
</table>
@endsection

@section('content-scripts')
<script>
    const table = document.querySelector('.table');
    fetch(`http://127.0.0.1:8000/api/admin/users/getall`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const users = data.data;
            let html = `
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Company</th>
                    <th scope="col">Status Acount</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
        `;
            users.forEach(user => {
                let lockStatus = user.lock === 1?'Active':'Locked';
                html += `
                <tr>
                    <th scope="row">${user.id}</th>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.phone}</td>
                    <td>${user.role? user.role.name: ''}</td>
                    <td>${user.company ? user.company.name : ''}</td>
                    <td>
                    <a class="btn btn-danger">${lockStatus}</a>
                    </td>
                    <td>
                    <a class="btn btn-primary" href="/users/edit/${user.id}">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            `;
            });
            html += `
            </tbody>
        `;
            table.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching data Users: ', error);
        });
</script>
@endsection