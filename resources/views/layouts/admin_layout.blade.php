<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>


    {{-- website logo  --}}
    <link rel="icon" type="image/x-icon" href="custom_images/website_logo.jpg">
    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- bootstrap 5  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('custom_css/admin/admin_layout.css') }}">

    @yield('styles')

</head>

<body>

    <!--  header Wrapper -->
    <div>
        <div>
            <nav class="navbar navbar-expand-sm ">
                <div class="container-fluid">
                    <a href="/admin" class="navbar-brand p-3 ms-3">Shopping Site</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        {{-- <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown">Messages</a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">Inbox</a>
                                    <a href="#" class="dropdown-item">Drafts</a>
                                    <a href="#" class="dropdown-item">Sent Items</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#"class="dropdown-item">Trash</a>
                                </div>
                            </li>
                        </ul> --}}
                        <ul class="nav navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35"
                                        height="35" class="rounded-circle"> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item"><i
                                            class="fa fa-user"></i> Profile</a>
                                    <a href="{{ route('admin.changePassword') }}" class="dropdown-item"><i
                                            class="fa fa-lock"></i> Change Password</a>
                                    <a href="/password/reset" class="dropdown-item"><i class="fa fa-eye"></i> Forgot
                                        Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <i class="ti ti-logout fs-6"></i>
                                        <span class="text-danger"> <i class="fa fa-sign-out"></i> Log out</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!--  body Wrapper -->
        <div class="row m-0 p-0 border ">
            <div class="col-2 menu_column m-0 p-0">


                <ul class="home_ul mt-4 m-0 p-0">
                    @php
                        use Illuminate\Support\Facades\Route;
                        use Illuminate\Support\Facades\Request;

                        $currentRoute = Route::currentRouteName();
                        $currentUrl = Request::path();
                    @endphp

                    <li class="nav-item home_li {{ $currentRoute == 'admin.dashboard' ? 'active' : '' }}">
                        <a class="nav-link home_li_a" href="{{ route('admin.dashboard') }}">
                            <span>
                                <i class="fa fa-home"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item home_li {{ $currentRoute == 'admin.usersAllOrder' ? 'active' : '' }}">
                        <a class="nav-link home_li_a" href="{{ route('admin.usersAllOrder') }}">
                            <span>
                                <i class="fa fa-shopping-bag"></i>
                            </span>
                            <span class="hide-menu">Manage Orders</span>
                        </a>
                    </li>

                    <li class="nav-item home_li {{ Request::is('admin/category*') ? 'active' : '' }}">
                        <a class="nav-link home_li_a" href="{{ route('category.index') }}">
                            <span>
                                <i class="fa fa-list"></i>
                            </span>
                            <span class="hide-menu">Manage Category</span>
                        </a>
                    </li>

                    <li class="nav-item home_li {{ Request::is('admin/product*') ? 'active' : '' }}">
                        <a class="nav-link home_li_a" href="{{ route('product.index') }}">
                            <span>
                                <i class="fa fa-product-hunt"></i>
                            </span>
                            <span class="hide-menu">Manage Products</span>
                        </a>
                    </li>

                    <li class="nav-item home_li {{ Request::is('admin/customer*') ? 'active' : '' }}">
                        <a class="nav-link home_li_a" href="{{ route('admin.manageCustomer.index') }}">
                            <span>
                                <i class="fa fa-users"></i>
                            </span>
                            <span class="hide-menu">Manage Customers</span>
                        </a>
                    </li>
                </ul>

            </div>

            <div class="col-10 content_column m-0 p-0">
                <div class="p-0 m-3 " style="background: #f0f0f0;">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    {{-- JQuery  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- sweet alert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>



    @if (session()->has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 5000,
            })
        </script>
    @endif

    @yield('scripts')

</body>
</html>
