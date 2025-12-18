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
            /* margin-top: 250px; */
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

        /* Auth Modal Styles */
        .auth-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }

        .auth-modal .modal-header {
            border-bottom: none;
            padding: 2rem 2rem 1rem;
        }

        .auth-modal .modal-body {
            padding: 1rem 2rem 2rem;
        }

        .auth-modal .modal-title {
            font-weight: 600;
            font-size: 1.75rem;
            color: #333;
        }

        .auth-modal .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }

        .auth-modal .form-control:focus {
            border-color: #007aff;
            box-shadow: 0 0 0 3px rgba(0,122,255,0.1);
        }

        .auth-modal .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }

        .auth-modal .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .auth-modal .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .auth-modal .btn-google {
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            color: #333;
            transition: all 0.3s;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .auth-modal .btn-google:hover {
            border-color: #4285f4;
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.2);
        }

        .auth-modal .btn-google img {
            width: 20px;
            height: 20px;
        }

        .auth-modal .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .auth-modal .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .auth-modal .divider span {
            background: #fff;
            padding: 0 15px;
            position: relative;
            color: #999;
        }

        .auth-modal .switch-auth {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .auth-modal .switch-auth a {
            color: #007aff;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-modal .switch-auth a:hover {
            text-decoration: underline;
        }

        .auth-modal .text-danger {
            font-size: 0.875rem;
            margin-top: 5px;
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Login
                        </button>
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

    @yield('scripts')

    <!-- Login Modal -->
    <div class="modal fade auth-modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}" class="btn btn-google mb-3">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input id="loginEmail" type="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus>

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input id="loginPassword" type="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required autocomplete="current-password">

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-submit text-white w-100 mb-3">
                            Login
                        </button>
                    </form>

                    @if (Route::has('password.request'))
                        <div class="text-center mb-3">
                            <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #007aff;">
                                Forgot your password?
                            </a>
                        </div>
                    @endif

                    <div class="switch-auth">
                        Don't have an account? 
                        <a href="javascript:void(0)" onclick="switchToRegister()">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade auth-modal" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Google Login Button -->
                    <a href="{{ route('auth.google') }}" class="btn btn-google mb-3">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label for="registerName" class="form-label">Name</label>
                            <input id="registerName" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required autocomplete="name">

                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input id="registerEmail" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required autocomplete="email">

                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input id="registerPassword" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required autocomplete="new-password">

                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="registerPasswordConfirm" class="form-label">Confirm Password</label>
                            <input id="registerPasswordConfirm" type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-submit text-white w-100 mb-3">
                            Register
                        </button>
                    </form>

                    <div class="switch-auth">
                        Already have an account? 
                        <a href="javascript:void(0)" onclick="switchToLogin()">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to switch from login to register modal
        function switchToRegister() {
            const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
            if (loginModal) {
                loginModal.hide();
            }
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        }

        // Function to switch from register to login modal
        function switchToLogin() {
            const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
            if (registerModal) {
                registerModal.hide();
            }
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }

        // Check URL parameter and open appropriate modal
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const openAuth = urlParams.get('openAuth');

            // Check if there are validation errors - if name field has errors, it's register form
            const hasRegisterErrors = @json($errors->has('name'));
            const hasAnyErrors = @json($errors->any());

            if (openAuth === 'login' || (hasAnyErrors && !hasRegisterErrors)) {
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
                // Clean URL
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (openAuth === 'register' || hasRegisterErrors) {
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
                // Clean URL
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        // Show success/error messages via SweetAlert if session has them
        @if (session()->has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

</body>
</html>
