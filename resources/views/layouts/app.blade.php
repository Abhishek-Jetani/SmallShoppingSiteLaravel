<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font (Apple-like minimal font) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App CSS & JS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Minimal CSS -->
    <style>
        body {
            background: #f5f7fa;
            font-family: "Inter", sans-serif;
        }

        /* Modern navbar */
        .navbar {
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.8);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Navbar hover */
        .nav-link:hover {
            color: #0d6efd !important;
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
            border-radius: 14px;
            padding: 1.8rem;
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; translate: 0px 12px; }
            to { opacity: 1; translate: 0px 0px; }
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
                                    <a class="nav-link fw-medium" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('register') }}">Register</a>
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
</body>
</html>
