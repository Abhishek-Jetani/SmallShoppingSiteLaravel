<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    @yield('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fafafa;
            opacity: 0;
            animation: fadeIn .6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Navbar */
        .navbar-nav .nav-link {
            font-weight: 500;
            transition: .3s;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important;
            transform: translateY(-2px);
        }

        .active_nav {
            color: #007bff !important;
            border-bottom: 2px solid #007bff;
        }

        /* Product Image Fallback */
        img.product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        img.product-img:not([src]), img.product-img[src=""] {
            content: url('{{ asset("images/default_product.png") }}');
        }

        /* Footer */
        .footer-area {
            background: #111;
            color: #ddd;
            padding: 60px 0;
        }

        .footer-area a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-area a:hover {
            color: white;
        }

        /* Loader */
        .lds-dual-ring,
        .lds-dual-ring:after {
            box-sizing: border-box;
        }

        .lds-dual-ring {
            margin-top: 250px;
            display: flex;
            justify-content: center;
        }

        .lds-dual-ring:after {
            content: " ";
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 6px solid currentColor;
            border-color: orangered transparent orangered transparent;
            animation: lds-dual-ring 1s linear infinite;
        }

        @keyframes lds-dual-ring {
            100% {
                transform: rotate(360deg);
            }
        }

        /* Card hover animation */
        .hover-card {
            transition: .3s;
        }

        .hover-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 8px 20px #00000029;
        }
    </style>
</head>

<body>

    <!-- LOADER -->
    <div class="lds-dual-ring"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/">
                <img src="{{ asset('images/bg_1.jpg') }}" width="50" class="rounded">
                <span class="ms-2">Small Shopping Site</span>
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-5 me-auto">
                    @php $r = Route::currentRouteName(); @endphp

                    <li class="nav-item">
                        <a class="nav-link {{ $r=='home' ? 'active_nav' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $r=='products.index' ? 'active_nav' : '' }}" href="{{ route('products.index') }}">Products</a>
                    </li>

                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ $r=='wishlist.index' ? 'active_nav' : '' }}" href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i> Wishlist</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ $r=='user.aboutus' ? 'active_nav' : '' }}" href="{{ route('user.aboutus') }}">About</a>
                    </li>
                </ul>

                <!-- Cart & Profile -->
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark position-relative">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="cart-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle"></span>
                    </a>

                    @if(Auth::check())
                        <div class="dropdown">
                            <a class="dropdown-toggle d-flex align-items-center text-dark fw-semibold" data-bs-toggle="dropdown">
                                <img src="../assets/images/profile/user-1.jpg" width="32" class="rounded-circle me-2">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('changePassword') }}"><i class="fa fa-lock"></i> Change Password</a></li>
                                <li>
                                    <a class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </li>
                            </ul>

                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN BODY -->
    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <!-- EXPANDED FOOTER -->
    <div class="footer-area">
        <div class="container">

            <!-- NEWSLETTER -->
            <div class="row mb-5 pb-4 border-bottom">
                <div class="col-md-6">
                    <h4>Stay Updated</h4>
                    <p>Get product updates, discounts & offers.</p>
                </div>
                <div class="col-md-6">
                    <form class="d-flex">
                        <input type="email" placeholder="Enter your email" class="form-control me-2">
                        <button class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h5>About</h5>
                    <p class="text-muted">We provide high quality products with fast delivery and customer support.</p>
                </div>

                <!-- FAQ -->
                <div class="col-md-4">
                    <h5>FAQ</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#">How do I place an order?</a></li>
                        <li><a href="#">Do you offer refunds?</a></li>
                        <li><a href="#">How fast is delivery?</a></li>
                        <li><a href="#">Do you have support?</a></li>
                    </ul>
                </div>

                <!-- NEWS -->
                <div class="col-md-4">
                    <h5>Latest News</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#">New arrivals are now live!</a></li>
                        <li><a href="#">Christmas sale starts soon</a></li>
                    </ul>
                </div>
            </div>

            <p class="text-center text-muted mt-4">© {{ date('Y') }} MyShop. All rights reserved.</p>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- CART COUNT AJAX -->
    <script>
        function updateCartCount() {
            $.get('/cart/count', function (data) {
                $('#cart-count').text(data.count);
            });
        }
        updateCartCount();

        // Hide loader on page load
        document.onreadystatechange = function () {
            if (document.readyState === "complete") {
                document.querySelector(".lds-dual-ring").style.display = "none";
            }
        };
    </script>

    @yield('scripts')

</body>
</html>
