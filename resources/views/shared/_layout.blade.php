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
    <!-- Đường dẫn asset() sẽ tự động tạo ra đường dẫn đúng đối với public/css/styles.css -->
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" >BookStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">Privacy</a>
                        </li>
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
                                    <a class="dropdown-item">Product</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="dropdown-item">Company</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="dropdown-item">Order</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="dropdown-item"  >User</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="dropdown-item">Create User</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            </ul>
                        </li>
                       
                    </ul>
        
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <main role="main" class="pb-3">
            @yield('content')
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
        <script src="~/lib/jquery/dist/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script></script>
</body>
</html>