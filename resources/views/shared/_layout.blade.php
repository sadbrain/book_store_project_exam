<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <!-- Latest compiled JavaScript -->
    <!-- Đường dẫn asset() sẽ tự động tạo ra đường dẫn đúng đối với public/css/styles.css -->
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a href="/" class="navbar-brand" style="position:relative; top:5px">BookStore</a>
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}
                <div class="navbar-collapse collapse row justify-content-between">
                    <ul class="navbar-nav me-auto col-10 d-block" style="position:relative; top:20px">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">Privacy</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/customer/listProduct')}}">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listCart') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorite') }}">Favorite</a>
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
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/product" class="dropdown-item">Product</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item">Company</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/order?status=all" class="dropdown-item">Order</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="/admin/users">User</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/user/create" class="dropdown-item">Create User</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                        @endif

                    </ul>
                    <ul class="navbar-nav col-2 d-block " style="position:relative; left:100px">
                        <li class="col-12 nav-item text-end">
                            {{-- <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a> --}}
                            @if(Auth::user())
                        <li class="nav-item dropdown" style="position: relative">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar }}" alt="User Avatar" style="width:50px;height: 50px;border-radius:50%;">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="position:absolute;left:-150%">
                                <li class="nav-item">
                                    <a class="dropdown-item">Name: <span>{{Auth::user()->name}}</span></a>
                                    <a class="dropdown-item">mail: <span>{{Auth::user()->email}}</span></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li class="nav-item">
                                    <a class="dropdown-item">Profile</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a href="/admin/order?status=all" class="dropdown-item">Order Management</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            </ul>
                        </li>
                        @else
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>

                        </li>

                        @endif

                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <main role="main" class="pb-3">
            @yield('content')
            {{-- @yield('list_product') --}}
            @extends('shared/_notification')

        </main>
    </div>

    <footer class="border-top footer bg-primary text-muted ">
        <div class="text-center">
            Made with <i class="bi bi-heart-fill"></i> by BookStore NT. Cretin
        </div>
    </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" asp-append-version="true"></script>

    <script src="https://cdn.tiny.cloud/1/g28lhnxtlihu4l4a381gw7tz47voznshwbi10lmsvlekrfme/tinymce/6/tinymce.min.js" referrerpolicy="origin">
        < script src = "~/lib/jquery/dist/jquery.min.js" >
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </script>
    @yield('content-scripts')
</body>

</html>