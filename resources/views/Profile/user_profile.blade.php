@extends('layouts.user_layout')

@section('content')

<style>
    /* Smooth fade-in animation */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .profile-card {
        border-radius: 18px;
        border: none;
        background: #ffffff;
        box-shadow: 0px 8px 25px rgba(0,0,0,0.08);
    }

    .form-control:focus {
        border-color: #007aff;
        box-shadow: 0 0 0 0.2rem rgba(0,122,255,.25);
    }

    .btn-apple {
        background: #007aff;
        border-radius: 10px;
        font-weight: 500;
        border: none;
        transition: 0.2s;
    }
    .btn-apple:hover {
        background: #005fcc;
    }

    .apple-input .form-floating > label {
        opacity: 0.7;
    }
</style>

<div class="py-5" style="background: #f5f5f7;">
    <div class="container fade-in">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">

                <div class="profile-card p-4 p-md-5">
                    <h3 class="text-center mb-4 fw-bold">Update Profile</h3>

                    <form id="profile_update_form" method="POST"
                        action="{{ route('profile.update', auth()->id()) }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-floating apple-input mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   name="name"
                                   id="name"
                                   value="{{ auth()->user()->name }}"
                                   placeholder="Your Name"
                                   required>
                            <label for="name">Your Name</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating apple-input mb-4">
                            <input type="email" 
                                   class="form-control" 
                                   name="email"
                                   id="email"
                                   value="{{ auth()->user()->email }}"
                                   placeholder="Email"
                                   required>
                            <label for="email">Email Address</label>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-apple w-100 py-2 fs-5">
                            Save Changes
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function () {

    jQuery.validator.addMethod("customemail", function(value, element) {
        return this.optional(element) ||
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/
            .test(value);
    }, "Please enter a valid email address");

    $('#profile_update_form').validate({
        rules: {
            name: { required: true, minlength: 3 },
            email: { required: true, customemail: true }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 3 characters"
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
