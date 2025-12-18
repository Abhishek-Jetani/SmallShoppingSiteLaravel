<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Small Shopping Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: "Inter", sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        /* Animated Background Shapes */
        .bg-shape { 
            position: absolute; 
            border-radius: 50%; 
            filter: blur(100px); 
            opacity: 0.4; 
            animation: float 8s ease-in-out infinite alternate; 
            z-index: 0;
        }
        .shape-1{ 
            width: 500px;
            height: 500px;
            background: rgba(108, 0, 255, 0.6); 
            top: -150px; 
            left: -150px; 
        }
        .shape-2{ 
            width: 600px;
            height: 600px;
            background: rgba(0, 162, 255, 0.5); 
            bottom: -200px; 
            right: -200px; 
            animation-delay: 2s; 
        }
        .shape-3 {
            width: 400px;
            height: 400px;
            background: rgba(255, 0, 150, 0.4);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 4s;
        }
        @keyframes float { 
            from { transform: translateY(0) scale(1); } 
            to { transform: translateY(30px) scale(1.1); } 
        }

        /* Login Card */
        .login-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card { 
            backdrop-filter: blur(20px) saturate(180%); 
            background: linear-gradient(145deg, rgba(255,255,255,0.15), rgba(255,255,255,0.05)); 
            border: 1px solid rgba(255,255,255,0.2); 
            border-radius: 24px; 
            padding: 48px 40px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.1) inset;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
            background-size: 200% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.15) inset;
        }

        /* Logo/Icon */
        .login-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .login-icon i {
            font-size: 36px;
            color: rgba(255,255,255,0.95);
        }

        /* Typography */
        .title-text{ 
            font-weight: 800; 
            letter-spacing: -1px; 
            font-size: 32px;
            margin-bottom: 8px;
            text-align: center;
            background: linear-gradient(135deg, #fff, rgba(255,255,255,0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .subtitle-text{ 
            color: rgba(255,255,255,0.85); 
            text-align: center;
            font-size: 15px;
            margin-bottom: 32px;
            font-weight: 400;
        }

        /* Form Elements */
        label{ 
            color: rgba(255,255,255,0.95); 
            font-weight: 600; 
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control{ 
            background: rgba(255,255,255,0.1); 
            border: 1.5px solid rgba(255,255,255,0.2); 
            color: #fff; 
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .form-control:focus{ 
            background: rgba(255,255,255,0.15); 
            box-shadow: 0 8px 30px rgba(0,0,0,0.3), 0 0 0 4px rgba(255,255,255,0.1); 
            border-color: rgba(255,255,255,0.4);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: rgba(255,255,255,0.3);
        }

        /* Button */
        .btn-main{ 
            width: 100%; 
            border-radius: 12px; 
            font-weight: 700; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none; 
            color: white; 
            padding: 16px;
            font-size: 16px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 8px;
        }

        .btn-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-main:hover::before {
            left: 100%;
        }

        .btn-main:hover{ 
            transform: translateY(-3px); 
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }

        .btn-main:active {
            transform: translateY(-1px);
        }

        /* Error Messages */
        .text-danger {
            color: #ff6b9d !important;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .is-invalid {
            border-color: rgba(255, 107, 157, 0.6) !important;
        }

        /* Brand Watermark */
        .brand-large{ 
            position: absolute; 
            right: 30px; 
            bottom: 30px; 
            opacity: 0.05; 
            font-weight: 900; 
            font-size: 180px; 
            transform: rotate(-15deg);
            pointer-events: none;
            z-index: 0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 36px 28px;
                border-radius: 20px;
            }
            .title-text {
                font-size: 28px;
            }
            .login-icon {
                width: 70px;
                height: 70px;
            }
            .login-icon i {
                font-size: 32px;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }
    </style>
</head>
<body>

    @if (session()->has('error'))
        <script>
            window.addEventListener('DOMContentLoaded', function(){
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Login Failed', 
                    text: {!! json_encode(session('error')) !!}, 
                    timer: 4000, 
                    showConfirmButton: false,
                    background: 'rgba(102, 126, 234, 0.95)',
                    color: '#fff',
                    backdrop: 'rgba(0,0,0,0.4)'
                });
            });
        </script>
    @endif

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

    <div class="login-container">
        <div class="login-card text-white">
            <div class="login-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            
            <h2 class="title-text">Admin Portal</h2>
            <p class="subtitle-text">Sign in to access your dashboard</p>

            <form method="POST" action="{{ route('admin.admin_login') }}" id="loginForm">
                @csrf

                <div class="mb-4">
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        required 
                        autocomplete="email" 
                        autofocus
                        placeholder="admin@example.com"
                    >
                    @error('email')
                        <div class="text-danger small mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <div class="text-danger small mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-main">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            </form>
        </div>
        <div class="brand-large">SS</div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-main');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing in...';
            btn.disabled = true;
            btn.classList.add('loading');
        });
    </script>
</body>
</html>
