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

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

        /* Modern gradient buttons */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Pulse animation for badges */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .pulse-badge {
            animation: pulse 2s infinite;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
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
                        <li class="nav-item">
                            <a class="nav-link {{ $r=='order.getUserOrders' ? 'active_nav' : '' }}" href="{{ route('order.getUserOrders') }}"><i class="fa fa-shopping-bag"></i> My Orders</a>
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
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#authModal">
                            <i class="fa fa-sign-in-alt me-2"></i>Login
                        </a>
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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>

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

    <!-- Auth Modal (Login/Register) -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:20px;overflow:hidden;border:none;box-shadow:0 20px 60px rgba(0,0,0,0.3);">
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-block position-relative" style="background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div style="position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;padding:40px;color:white;">
                            <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:15px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                                <i class="fa fa-shopping-bag" style="font-size:28px;"></i>
                            </div>
                            <h3 style="font-weight:700;letter-spacing:-0.6px;margin-bottom:12px;font-size:28px;">Welcome Back!</h3>
                            <p style="opacity:0.95;margin-bottom:24px;font-size:15px;">Sign in to access your account and enjoy seamless shopping experience.</p>
                            <ul style="padding-left:0;list-style:none;opacity:0.95;">
                                <li style="margin-bottom:12px;"><i class="fa fa-check-circle me-2"></i>Fast & secure checkout</li>
                                <li style="margin-bottom:12px;"><i class="fa fa-check-circle me-2"></i>Track your orders</li>
                                <li style="margin-bottom:12px;"><i class="fa fa-check-circle me-2"></i>Save multiple addresses</li>
                                <li><i class="fa fa-check-circle me-2"></i>Wishlist & favorites</li>
                            </ul>
                        </div>
                        <div style="position:absolute;right:20px;bottom:20px;opacity:0.1;font-weight:900;font-size:140px;transform:rotate(-12deg);">SS</div>
                    </div>
                    <div class="col-md-7 col-12">
                        <div class="p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0 fw-bold" style="font-size:24px;">Account</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <ul class="nav nav-tabs mb-4" id="authTab" role="tablist" style="border-bottom:2px solid #e9ecef;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-semibold" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane" type="button" role="tab" style="border:none;border-bottom:3px solid #667eea;color:#667eea;">Login</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-semibold" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-pane" type="button" role="tab" style="border:none;color:#6c757d;">Register</button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="login-pane" role="tabpanel">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control" required autofocus placeholder="Enter your email" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Enter your password" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" style="text-decoration:none;color:#667eea;">Forgot password?</a>
                                            @endif
                                        </div>
                                        <div class="d-grid mb-3">
                                            <button class="btn btn-primary btn-lg" style="border-radius:10px;padding:12px;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);border:none;">
                                                <i class="fa fa-sign-in-alt me-2"></i>Sign In
                                            </button>
                                        </div>
                                        <div class="text-center mb-3">
                                            <span class="text-muted small">Or continue with</span>
                                        </div>
                                        <div class="d-grid">
                                            <a href="{{ route('auth.google') }}" class="btn btn-outline-danger" style="border-radius:10px;padding:12px;border:2px solid #dc3545;">
                                                <i class="fab fa-google me-2"></i>Continue with Google
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="register-pane" role="tabpanel">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Full Name</label>
                                            <input type="text" name="name" class="form-control" required placeholder="Enter your full name" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email" class="form-control" required placeholder="Enter your email" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Create a password" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm your password" style="border-radius:10px;padding:12px;">
                                        </div>
                                        <div class="d-grid mb-3">
                                            <button class="btn btn-primary btn-lg" style="border-radius:10px;padding:12px;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);border:none;">
                                                <i class="fa fa-user-plus me-2"></i>Create Account
                                            </button>
                                        </div>
                                        <div class="text-center mb-3">
                                            <span class="text-muted small">Or continue with</span>
                                        </div>
                                        <div class="d-grid">
                                            <a href="{{ route('auth.google') }}" class="btn btn-outline-danger" style="border-radius:10px;padding:12px;border:2px solid #dc3545;">
                                                <i class="fab fa-google me-2"></i>Continue with Google
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')

</body>
</html>
