<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="custom_images/website_logo.jpg">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">

    {{-- NEW BLUE THEME STYLE --}}
    <style>
        body {
            background: #f4f6fc;
            font-family: "Segoe UI", sans-serif;
        }

        /* Navbar */
        .navbar {
            background: #1e3c76 !important;
            padding: 10px 20px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .15);
        }

        .navbar-brand,
        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
        }

        /* Sidebar */
        .menu_column {
            background: #ffffff;
            border-right: 1px solid #e0e3ed;
            min-height: 100vh;
            padding-top: 20px;
            animation: fadeSidebar 0.5s ease;
        }

        .home_ul li {
            list-style: none;
        }

        .home_li {
            padding: 14px 20px;
            transition: 0.3s;
            margin-bottom: 3px;
        }

        .home_li a {
            color: #1e3c76;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .home_li:hover {
            background: #1e3c76;
        }

        .home_li:hover a {
            color: white;
        }

        .home_li.active {
            background: #1e3c76;
        }

        .home_li.active a {
            color: white;
        }

        /* Main content */
        .content_column {
            padding: 25px;
        }

        .content-card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: rgba(0, 0, 0, 0.05) 0 8px 24px;
        }

        /* Sidebar animation */
        @keyframes fadeSidebar {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    @yield('styles')
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">

            <a href="/admin" class="navbar-brand">Shopping Site</a>

            <button class="navbar-toggler bg-light" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarCollapse" class="collapse navbar-collapse">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown me-3">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="../assets/images/profile/user-1.jpg" width="36" height="36"
                                class="rounded-circle me-1">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.changePassword') }}" class="dropdown-item">
                                    <i class="fa fa-lock"></i> Change Password
                                </a>
                            </li>
                            <li>
                                <a href="/password/reset" class="dropdown-item">
                                    <i class="fa fa-key"></i> Forgot Password
                                </a>
                            </li>
                            <li><hr></li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <!-- PAGE -->
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-2 menu_column">

            <ul class="home_ul">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp

                <li class="home_li {{ $currentRoute == 'admin.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="home_li {{ $currentRoute == 'admin.usersAllOrder' ? 'active' : '' }}">
                    <a href="{{ route('admin.usersAllOrder') }}">
                        <i class="fa fa-shopping-bag"></i> Manage Orders
                    </a>
                </li>

                <li class="home_li {{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <i class="fa fa-folder"></i> Manage Category
                    </a>
                </li>

                <li class="home_li {{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}">
                        <i class="fa fa-box"></i> Manage Products
                    </a>
                </li>

                <li class="home_li {{ Request::is('admin/customer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manageCustomer.index') }}">
                        <i class="fa fa-users"></i> Manage Customers
                    </a>
                </li>

                <li class="home_li {{ $currentRoute == 'admin.reports' ? 'active' : '' }}">
                    <a href="{{ route('admin.reports') }}">
                        <i class="fa fa-chart-line"></i> Reports & Analytics
                    </a>
                </li>
            </ul>

        </div>

        <!-- CONTENT -->
        <div class="col-10 content_column">
            <div class="content-card">
                @yield('content')
            </div>
        </div>

    </div>

    {{-- JS Libraries --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>

    {{-- Alerts --}}
    @if(session()->has('success'))
    <script>
        Swal.fire({ icon: "success", title: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
    </script>
    @endif

    @if(session()->has('error'))
    <script>
        Swal.fire({ icon: "error", title: "{{ session('error') }}", timer: 2000, showConfirmButton: false });
    </script>
    @endif

    @yield('scripts')

</body>
</html>
