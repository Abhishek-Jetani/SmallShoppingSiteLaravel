<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Sign-In -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <!-- App CSS & JS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Minimal CSS -->
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f59e0b;
        }

        * {
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: "Poppins", sans-serif;
        }

        /* Modern navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.85) !important;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .navbar:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        /* Navbar hover */
        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Page fade animation */
        main {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; translate: 0px 8px; }
            to { opacity: 1; translate: 0px 0px; }
        }

        /* Card minimal style */
        .app-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; translate: 0px 12px; }
            to { opacity: 1; translate: 0px 0px; }
        }

        /* Modal Styles */
        .modal-content {
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 20px;
            background: #fff;
        }

        .modal-header {
            border: none;
            padding: 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .modal-header .btn-close {
            background-color: rgba(255,255,255,0.8);
            filter: none;
        }

        .modal-title {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-tabs {
            border: none;
            gap: 1rem;
        }

        .nav-tabs .nav-link {
            color: #666 !important;
            border: none;
            border-bottom: 3px solid transparent;
            font-weight: 600;
            padding-bottom: 0.8rem;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color) !important;
            border-bottom-color: var(--primary-color) !important;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color) !important;
            border-bottom-color: var(--primary-color) !important;
            background: transparent;
        }

        /* Form Controls */
        .form-control {
            border: 1.5px solid rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: var(--primary-color);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.6rem;
            font-size: 14px;
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            border-radius: 10px;
            padding: 11px 24px;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn-dark {
            background: linear-gradient(135deg, #333, #1a1a1a);
            border: none;
        }

        .btn-dark:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, var(--secondary-color), #667eea);
        }

        .btn-outline-secondary {
            border: 1.5px solid #ddd;
            color: #333;
            border-radius: 10px;
        }

        .btn-outline-secondary:hover {
            background: #f8f9fa;
            border-color: var(--primary-color);
        }

        /* Social Buttons */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: 1.5px solid #ddd;
            color: #333;
            background: white;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 600;
        }

        .social-btn:hover {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 16px;
        }

        .text-muted-light {
            color: #999;
            font-size: 13px;
            text-align: center;
            margin: 1rem 0;
        }

        .divider-text {
            position: relative;
            text-align: center;
            margin: 1.5rem 0 1rem;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 35%;
            height: 1px;
            background: #ddd;
        }

        .divider-text::before {
            left: 0;
        }

        .divider-text::after {
            right: 0;
        }

        .divider-text span {
            background: white;
            padding: 0 10px;
            color: #999;
            font-size: 13px;
            font-weight: 500;
        }

        /* Dropdown */
        .dropdown-menu {
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        .dropdown-item {
            padding: 10px 16px;
            color: #333;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: var(--primary-color);
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm sticky-top">
            <div class="container py-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto"></ul>

                    <!-- AUTH SECTION -->
                    <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link fw-medium" href="#" data-bs-toggle="modal" data-bs-target="#authModal">Login / Register</a>
                                    </li>
                                @endif

                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold" href="#" 
                                   data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            <div class="app-card">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auth Modal (Login/Register) -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-lock me-2"></i>Your Account
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <ul class="nav nav-tabs mb-4" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane" type="button" role="tab" aria-selected="true">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-pane" type="button" role="tab" aria-selected="false">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Login Tab -->
                        <div class="tab-pane fade show active" id="login-pane" role="tabpanel">
                            <form method="POST" action="{{ route('login') }}" id="loginFormModal">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>Email Address
                                    </label>
                                    <input type="email" name="email" class="form-control" placeholder="your@email.com" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-key me-2" style="color: var(--primary-color);"></i>Password
                                    </label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-decoration-none" style="font-size: 13px;">Forgot password?</a>
                                    @endif
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-dark btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                    </button>
                                </div>

                                <div class="divider-text">
                                    <span>Or continue with</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" class="btn social-btn" id="googleLoginBtn">
                                        <i class="fab fa-google"></i>Google
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Register Tab -->
                        <div class="tab-pane fade" id="register-pane" role="tabpanel">
                            <form method="POST" action="{{ route('register') }}" id="registerFormModal">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2" style="color: var(--primary-color);"></i>Full Name
                                    </label>
                                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>Email Address
                                    </label>
                                    <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-2" style="color: var(--primary-color);"></i>Password
                                    </label>
                                    <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-lock me-2" style="color: var(--primary-color);"></i>Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-check me-2"></i>Create Account
                                    </button>
                                </div>

                                <div class="divider-text">
                                    <span>Or sign up with</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" class="btn social-btn" id="googleSignupBtn">
                                        <i class="fab fa-google"></i>Google
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // Handle opening auth modal from query param
            try {
                const params = new URLSearchParams(window.location.search);
                const open = params.get('openAuth');
                if (open) {
                    const el = document.getElementById('authModal');
                    if (el) {
                        const modal = new bootstrap.Modal(el);
                        if (open === 'register') {
                            var registerTab = document.getElementById('register-tab');
                            if (registerTab) registerTab.click();
                        }
                        modal.show();
                        if (history.replaceState) {
                            const url = new URL(window.location);
                            url.searchParams.delete('openAuth');
                            history.replaceState(null, '', url.pathname + url.hash);
                        }
                    }
                }
            } catch (e) {
                console.error('Error opening auth modal:', e);
            }

            // Google Sign-In Button Handlers
            const googleLoginBtn = document.getElementById('googleLoginBtn');
            const googleSignupBtn = document.getElementById('googleSignupBtn');

            if (googleLoginBtn) {
                googleLoginBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (typeof google !== 'undefined') {
                        google.accounts.id.initialize({
                            client_id: '{{ config("services.google.client_id") }}',
                            callback: handleGoogleSignIn
                        });
                        google.accounts.id.prompt();
                    } else {
                        Swal.fire('Error', 'Google Sign-In is not available. Please try again.', 'error');
                    }
                });
            }

            if (googleSignupBtn) {
                googleSignupBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (typeof google !== 'undefined') {
                        google.accounts.id.initialize({
                            client_id: '{{ config("services.google.client_id") }}',
                            callback: handleGoogleSignUp
                        });
                        google.accounts.id.prompt();
                    } else {
                        Swal.fire('Error', 'Google Sign-In is not available. Please try again.', 'error');
                    }
                });
            }
        });

        // Handle Google Sign-In Response
        function handleGoogleSignIn(response) {
            if (response.credential) {
                fetch('{{ route("auth.google") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        token: response.credential,
                        type: 'login'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        Swal.fire('Error', data.message || 'Login failed', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An error occurred during login', 'error');
                });
            }
        }

        // Handle Google Sign-Up Response
        function handleGoogleSignUp(response) {
            if (response.credential) {
                fetch('{{ route("auth.google") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        token: response.credential,
                        type: 'signup'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        Swal.fire('Error', data.message || 'Registration failed', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An error occurred during registration', 'error');
                });
            }
        }
    </script>
</body>
</html>
