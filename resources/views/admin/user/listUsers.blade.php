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
                html += `
                <tr>
                    <th scope="row">${user.id}</th>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.phone}</td>
                    <td>${user.role? user.role.name: ''}</td>
                    <td>${user.company ? user.company.name : ''}</td>
                    <td>
                    
                    <form method="post" action="/admin/user/change-account-status/${user.id}" data-user-id="${user.id}">
                    @csrf
                    <input type="hidden" name="user[id]" value="${user.id}">
                    <button type="submit" class="btn btn-link" data-toggle="collapse" data-target="#accountCollapse" aria-expanded="true"               aria-controls="accountCollapse" data-open-icon="fa-lock-open" data-lock-icon="fa-lock">
                        <i id="accountIcon" class="fas ${user.lock == 0 ? 'fa-lock-open' : 'fa-lock'} mr-2"></i> Tài khoản
                        <input type="hidden" name="user[lock]" value="${user.lock}">
                    </button>
                    </form>
                    </td>
                    <td>
                    <a class="btn btn-primary" href="/admin/users/edit/${user.id}">Edit</a>
                    <a class="btn btn-danger"  onclick="deleteUser(${user.id})">Delete</a>
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

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();

        var accountIcon = document.getElementById('accountIcon');
        var openIconClass = accountIcon.dataset.openIcon;
        var lockIconClass = accountIcon.dataset.lockIcon;
        var userId = accountIcon.dataset.userId; // Lấy id của người dùng từ thuộc tính data

        if (accountIcon.classList.contains(openIconClass)) {
            accountIcon.classList.remove(openIconClass);
            accountIcon.classList.add(lockIconClass);
        } else {
            accountIcon.classList.remove(lockIconClass);
            accountIcon.classList.add(openIconClass);
        }

        // Gửi yêu cầu AJAX để thay đổi dữ liệu lock
        fetch(`/admin/user/change-account-status/${userId}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                // Xử lý phản hồi từ máy chủ (nếu cần)
                console.log(data);

                // Thay đổi trạng thái lock trên giao diện dựa trên phản hồi từ máy chủ
                if (data && data.data && data.data.lock) {
                    accountIcon.classList.remove(openIconClass);
                    accountIcon.classList.add(lockIconClass);
                } else {
                    accountIcon.classList.remove(lockIconClass);
                    accountIcon.classList.add(openIconClass);
                }

                // Tải lại trang sau khi nhận được phản hồi từ máy chủ
                window.location.reload();
            })
            .catch(error => {
                console.error('Error changing account status: ', error);
            });

        // Ẩn/hiện nội dung khi nhấp vào nút Tài khoản
        var accountCollapse = document.getElementById('accountCollapse');
        if (accountCollapse.classList.contains('show')) {
            accountCollapse.classList.remove('show');
        } else {
            accountCollapse.classList.add('show');
        }
    });

    function deleteUser(userId){
        if(confirm('Are you sure to delete this user?')){
            fetch(`http://127.0.0.1:8000/api/admin/user/delete/${userId}`,{
                method: "DELETE"
            })
            .then(response =>{
                if (response.ok){
                    console.log("User delete Success")
                    window.location.reload();
                }else{
                    console.log("error")
                }
            })
            .catch(error => {
                console.error("Error: ", error)
            })
        }
    }
</script>
@endsection