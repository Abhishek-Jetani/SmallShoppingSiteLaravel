@extends('layouts.admin_layout')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="container-fluid bg-light pb-2">
        <div class="col-md-6 offset-3 pt-4">
            <h3 class="text-center">Change Password</h3>

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
                <div style="color:green">{{ Session::get('success') }}</div>
                @php
                    Session::put('success', null);
                @endphp
            @endif

            <form class="form" action="{{ route('admin.postChangePassword') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary text-center">Submit</button>
            </form>

        </div>
    </div>
    </body>
@endsection
