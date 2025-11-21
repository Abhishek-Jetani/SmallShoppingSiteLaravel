@extends('layouts.admin_layout')
@section('title')
    Change Password
@endsection

@section('styles')
<style>
    .form-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: rgba(100, 100, 111, 0.20) 0px 7px 25px 0px;
        transition: 0.2s;
    }
    .form-card:hover {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 10px 30px;
    }
    .form-card h3 {
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container-fluid bg-light pb-5">
    <div class="col-md-6 offset-md-3 pt-5">

        <div class="form-card">

            <h3 class="text-center mb-4">🔐 Change Password</h3>

            {{-- Error & success alerts --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                </div>
            @endif

            @if (Session::get('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @php Session::put('error', null); @endphp
            @endif

            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @php Session::put('success', null); @endphp
            @endif

            <form class="form" action="{{ route('admin.postChangePassword') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-bold">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label fw-bold">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Create new password">
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Re-enter new password">
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    Update Password
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
