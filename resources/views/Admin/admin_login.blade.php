<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: "Inter", sans-serif;
            background: linear-gradient(135deg, #10131a, #1b1e28);
            overflow: hidden;
        }

        /* Moving animated circles (Apple style) */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float 6s ease-in-out infinite alternate;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: #6c00ff;
            top: -100px;
            left: -120px;
        }

        .shape-2 {
            width: 600px;
            height: 600px;
            background: #00a2ff;
            bottom: -150px;
            right: -180px;
            animation-delay: 2.5s;
        }

        @keyframes float {
            from { transform: translateY(0px); }
            to   { transform: translateY(40px); }
        }

        /* Glass Card */
        .login-card {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.25);
            animation: fadeUp 0.7s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        label {
            font-weight: 500;
            color: #d8d8d8;
        }

        .form-control {
            background: rgba(255,255,255,0.12);
            border: none;
            color: white;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.16);
            box-shadow: none;
            border: 1px solid #0d6efd;
            color: white;
        }

        .title-text {
            color: white;
            font-weight: 600;
        }

        .subtitle-text {
            color: #d0d0d0;
            font-size: 0.9rem;
        }

        .btn-main {
            width: 100%;
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false,
            });
        </script>
    @endif

    <!-- Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

        <div class="col-md-5 login-card text-white">
            <h2 class="mb-1 title-text">Admin Login</h2>
            <p class="mb-4 subtitle-text">Small Shopping Portal Dashboard</p>

            <form method="POST" action="{{ route('admin.admin_login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label>Password</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-main">
                    Login
                </button>

            </form>
        </div>

    </div>

</body>
</html>
