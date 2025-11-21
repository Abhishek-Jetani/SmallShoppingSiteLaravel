@extends('layouts.admin_layout')
@section('title')
    Profile
@endsection

@section('styles')
<style>
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: rgba(0,0,0,0.08) 0px 4px 20px;
    }

    .profile-title {
        font-weight: 600;
        font-size: 24px;
        margin-bottom: 25px;
    }

    .apple-input {
        border-radius: 10px;
        height: 45px;
    }

    .apple-btn {
        background-color: #007aff;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        border: none;
        transition: .2s;
    }

    .apple-btn:hover {
        background-color: #0066d6;
        color: white;
    }

    form .error {
        color: #ff3b30;
        font-size: 13px;
    }

</style>
@endsection

@section('content')

<div class="container mt-5">

    <div class="profile-card">

        <h2 class="profile-title">Update Profile</h2>

        <form id="profile_update_form"
              method="POST"
              action="{{ route('admin.profile.update', auth()->id()) }}"
              enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control apple-input"
                           value="{{ auth()->user()->name }}"
                           required
                           autofocus>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="text"
                           id="email"
                           name="email"
                           class="form-control apple-input"
                           value="{{ auth()->user()->email }}"
                           placeholder="john@example.com"
                           required>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="apple-btn">
                        Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>

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
        /^([\w-\.]+)@((\[[0-9]{1,3}\.)|([\w-]+\.)+)([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
    }, "Please enter a valid email address");

    $('#profile_update_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                customemail: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "At least 3 characters required",
            },
            email: {
                required: "Please enter your email",
                customemail: "Please enter a valid email",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

});
</script>
@endsection
