@extends('layouts.admin_layout')
@section('title')
    Profile
@endsection
@section('styles')
    <style>
        form .error {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <form id="profile_update_form" method="POST" action="{{ route('admin.profile.update', auth()->id()) }}"
            enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="card-body">

                <h2 class="mt-5">Update Profile</h2>

                <div class="row mt-5">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ auth()->user()->name }}" autofocus="" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="text" id="email" name="email"
                            value="{{ auth()->user()->email }}" placeholder="john.doe@example.com">
                    </div>
                    <div class="mb-3 col-md-6">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            jQuery.validator.addMethod("customemail", function(value, element) {
                return this.optional(element) ||
                    /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/
                    .test(value);
            }, "Please enter a valid email address");

            $('#profile_update_form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        customemail: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must be at least 3 characters long"
                    },
                    email: {
                        required: "Please enter your email",
                        customemail: "Please enter a valid email address"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
