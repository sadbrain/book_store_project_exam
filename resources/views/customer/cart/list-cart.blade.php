<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" />
</head>

<body>
<header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a  href="/" class="navbar-brand" >BookStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">Privacy</a>
                        </li>

                        @if(Auth::user() && Auth::user()->role->name == config("constants.role.user_admin"))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Content Management
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-item">
                                        <a class="dropdown-item">Category</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a href="/admin/product" class="dropdown-item">Product</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">Company</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a  href="/admin/order?status=all" class="dropdown-item">Order</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a class="dropdown-item"  >User</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a href="/admin/user/create" class="dropdown-item">Create User</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </li>
                        @endif
                       
                    </ul>
        
                    <ul class="navbar-nav">
                        @if (Route::has('login'))
                                @auth
                                <li class="nav-item" >
                                    {{-- <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a> --}}
                                    @if(Auth::check())
                                        <li class="nav-item dropdown" style="position: relative">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ Auth::user()->avatar }}" alt="User Avatar"  style="width:50px;height: 50px;border-radius:50%;">
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="position:absolute;left:-150%">
                                                <li class="nav-item">
                                                    <a class="dropdown-item">Name: <span>{{Auth::user()->name}}</span></a>
                                                    <a class="dropdown-item">mail: <span>{{Auth::user()->email}}</span></a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>

                                                <li class="nav-item">
                                                    <a class="dropdown-item">Profile</a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li class="nav-item">
                                                    <a  href="/admin/order?status=all" class="dropdown-item">Order Management</a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li class="nav-item">
                                                    <a  class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>      
                                            </ul>
                                        </li>
                                    @endif
                                </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                    </li>
            
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>

                                    </li>

                                    @endif
                                @endauth
                        @endif

                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                            <form action="" method="POST">
                                <tbody>

                                </tbody>
                            </form>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    const tableBody = document.querySelector('tbody');
    fetch(`http://127.0.0.1:8000/api/customer/show-item-into-cart`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            const products = data.data
            console.log(products);

            // Tạo các phần tử <th>
            const thShoppingBag = document.createElement('th');
            thShoppingBag.setAttribute('scope', 'col');
            thShoppingBag.textContent = 'Shopping Bag';

            const thQuantity = document.createElement('th');
            thQuantity.setAttribute('scope', 'col');
            thQuantity.textContent = 'Quantity';

            const thPrice = document.createElement('th');
            thPrice.setAttribute('scope', 'col');
            thPrice.textContent = 'Price';

            // Tạo phần tử <tr>
            const tr = document.createElement('tr');
            tr.appendChild(thShoppingBag);
            tr.appendChild(thQuantity);
            tr.appendChild(thPrice);



            // Thêm phần tử <tr> vào <thead>
            const thead = document.querySelector('thead');
            thead.appendChild(tr);

            products.forEach(product => {
                fetch(`http://127.0.0.1:8000/api/customer/get-product-by-id/${product.product_id}`)
                    .then(response => response.json())
                    .then(productData => {
                        const {
                            name
                        } = productData.data
                        const {
                            author
                        } = productData.data
                        const {
                            image_url
                        } = productData.data
                        const {
                            description
                        } = productData.data
                        const {
                            price
                        } = productData.data

                        // Tạo các phần tử DOM
                        const tr = document.createElement('tr');
                        const tdName = document.createElement('td');
                        const tdQuantity = document.createElement('td');
                        const tdPrice = document.createElement('td');


                        // Thiết lập nội dung cho các phần tử
                        tdName.innerHTML = `
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-5 col-lg-5 col-xl-5">
                                            <img src="${image_url}" class="img-fluid rounded-3" style="width: 200px; heigh: 200px" alt="Book">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">${name}</p>
                                            <p><span class="text-muted">Author: </span>${author}</p>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        tdQuantity.innerHTML = `<div class="col-md-5 col-lg-5 col-xl-2 d-flex">
    <button class="btn btn-success px-2 m-lg-2" onclick="minusQuantity(${product.id})">
        -
    </button>
    <input id="form${product.product_id}" min="0" name="quantity" value="${product.count}" type="number" class="form-control form-control-lg px-10 h-10 w-10" placeholder="${product.count}" />
    <button class="btn btn-warning px-2 m-lg-2" onclick="plusQuantity(${product.id})">
        +
    </button>
    <button class="btn btn-warning px-2 m-lg-2" onclick="deleteCart(${product.id})">
        Delete
    </button>

    
</div>`
                        tdPrice.textContent = price;


                        // Gắn các phần tử con vào phần tử cha
                        tr.appendChild(tdName);
                        tr.appendChild(tdQuantity);
                        tr.appendChild(tdPrice);

                        // Gắn phần tử cha vào tbody
                        tableBody.appendChild(tr);
                    });
            });
        })
        .catch(error => {
            console.log('Error fetching data Product: ', error);
        });


    function deleteCart(product_id) {
        fetch(`http://127.0.0.1:8000/api/customer/delete-from-cart/${product_id}`, {
                method: "GET",
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                    console.log("Delete OK ")
                } else {
                    console.log(product_id)
                    console.log('Delete Failed')
                }
            })
            .catch(error => {
                console.log('Error deleting item: ', error);
            })
    }

    function minusQuantity(product_id){
        fetch(`http://127.0.0.1:8000/api/customer/minus-cart-count/${product_id}`, {
            method : "GET"
        })
        .then(response => {
            if(response.ok){
                console.log("Minus Ok")
            }
            else{
                console.log(product_id)
                console.log("Minus Failed")
            }
        })
        .catch (error => {
            console.log("Error Minusting: ", error)
        })
    }

    function plusQuantity(product_id){
        fetch(`http://127.0.0.1:8000/api/customer/plus-cart-count/${product_id}`, {
            method : "GET"
        })
        .then(response => {
            if(response.ok){
                console.log("plus Ok")
            }
            else{
                console.log(product_id)
                console.log("plus Failed")
            }
        })
        .catch (error => {
            console.log("Error plusting: ", error)
        })
    }
</script>

</html>