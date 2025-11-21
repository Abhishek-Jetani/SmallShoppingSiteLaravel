@extends('layouts.app')

@section('content')

<style>
    .apple-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 35px 40px;
        box-shadow: 0 10px 28px rgba(0,0,0,0.07);
        transition: 0.3s ease;
    }
    .apple-card:hover {
        box-shadow: 0 14px 32px rgba(0,0,0,0.10);
    }
    .apple-input {
        border-radius: 12px;
        height: 48px;
    }
    .apple-input:focus {
        border-color: #007aff;
        box-shadow: 0 0 0 3px rgba(0,122,255,0.25);
    }
    .apple-btn {
        border-radius: 10px;
        height: 48px;
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s;
    }
    .apple-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(0,122,255,0.25);
    }
    .apple-link {
        font-size: 14px;
        text-decoration: none;
        color: #007aff;
    }
    .apple-link:hover {
        text-decoration: underline;
    }
</style>

@if (session()->has('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        showCancelButton: false,
        showConfirmButton: false,
    });
</script>
@endif

@if (session()->has('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        showCancelButton: false,
        showConfirmButton: false,
        timer: 3000,
    });
</script>
@endif

<div class="py-5" style="background:#f5f5f7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                
                <div class="apple-card">

                    <h3 class="fw-light text-center mb-4">Login</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input id="email" type="email" 
                                   class="form-control apple-input @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}" 
                                   required autocomplete="email" autofocus>

                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" 
                                   class="form-control apple-input @error('password') is-invalid @enderror"
                                   name="password"
                                   required autocomplete="current-password">

                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   name="remember"
                                   id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary apple-btn">
                                Login
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a href="{{ route('password.request') }}" class="apple-link">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
