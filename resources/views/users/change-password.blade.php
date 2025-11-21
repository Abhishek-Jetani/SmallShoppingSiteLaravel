@extends('layouts.user_layout')
@section('title', 'Change Password')

@section('content')

<style>
    .apple-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        transition: 0.3s ease;
    }
    .apple-card:hover {
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    }
    .apple-input {
        border-radius: 10px;
        height: 48px;
    }
    .apple-input:focus {
        box-shadow: 0 0 0 3px rgba(0,122,255,0.2);
        border-color: #007aff;
    }
    .apple-btn {
        border-radius: 10px;
        height: 48px;
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s ease;
    }
    .apple-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(0,122,255,0.2);
    }
    .error-text {
        font-size: 14px;
        margin-top: 2px;
        color: #d50000;
    }
</style>

<!-- Page -->
<div class="py-4" style="background: #f5f5f7;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">
                
                <div class="apple-card">
                    
                    <h3 class="fw-light text-center mb-4">Change Password</h3>
                    
                    <form action="{{ route('postChangePassword') }}" method="post" id="changePasswordForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" 
                                   class="form-control apple-input" 
                                   name="current_password" 
                                   required>
                            @error('current_password')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" 
                                   class="form-control apple-input" 
                                   name="new_password" 
                                   required>
                            @error('new_password')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" 
                                   class="form-control apple-input" 
                                   name="new_password_confirmation" 
                                   required>
                            @error('new_password_confirmation')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Laravel error bags -->
                        @if ($errors->any())
                            <div class="error-text">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif

                        <!-- Session alerts -->
                        @if (Session::get('error'))
                            <div class="error-text">{{ Session::get('error') }}</div>
                            @php Session::put('error', null); @endphp
                        @endif

                        <!-- Success via SweetAlert -->
                        @if (Session::get('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ Session::get('success') }}',
                                    toast: true,
                                    timer: 2500,
                                    position: 'top-end',
                                    showConfirmButton: false
                                });
                            </script>
                            @php Session::put('success', null); @endphp
                        @endif

                        <div class="mt-4 d-grid">
                            <button class="btn btn-primary apple-btn" type="submit">
                                Update Password
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
