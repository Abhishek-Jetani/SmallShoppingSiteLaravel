@extends('layouts.user_layout')
@section('title')
    Change Password
@endsection
@section('content')

    <!-- Password Reset  -->
    <div class=" py-3 py-md-5" style="background: #f0f0f0;">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row gy-3 mb-3">
                            <div class="col-12">
                                <h2 class="fw-normal text-center  m-0 px-md-5">Change password</h2>
                            </div>
                        </div>


                        <form class="form mt-4" action="{{ route('postChangePassword') }}" method="post">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                                <div class="col-12">
                                    <label for="text" class="form-label">Current Password </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="current_password"
                                            value="{{ old('current_password') }}" id="current_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                                <div class="col-12">
                                    <label for="text" class="form-label">New Password </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="new_password" id="new_password"
                                            value="{{ old('new_password') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                                <div class="col-12">
                                    <label for="text" class="form-label">Confirm New Password </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="new_password_confirmation"
                                            value="{{ old('new_password_confirmation') }}"s id="new_password_confirmation"
                                            required>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                            @endif

                            @if (Session::get('error') && Session::get('error') != null)
                                <div style="color:red">{{ Session::get('error') }}</div>
                                @php
                                    Session::put('error', null);
                                @endphp
                            @endif
                            @if (Session::get('success') && Session::get('success') != null)
                                @if (session()->has('success'))
                                    <script>
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: "{{ session('success') }}"
                                        });
                                    </script>
                                @endif
                                @php
                                    Session::put('success', null);
                                @endphp
                            @endif

                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Reset Password</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
