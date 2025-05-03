@extends('layouts.user_layout')

@section('content')
    <div class=" py-3 py-md-5" style="background: #f0f0f0;">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                        <div class="row gy-3 mb-3">
                            <div class="col-12">
                                <h2 class="fw-normal text-center  m-0 px-md-5">Profile Update</h2>
                            </div>
                        </div>


                        <form id="profile_update_form" method="POST" action="{{ route('profile.update', auth()->id()) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                                <div class="col-12">
                                    <label for="text" class="form-label">Name </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ auth()->user()->name }}" id="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 overflow-hidden mt-1">
                                <div class="col-12">
                                    <label for="text" class="form-label">Email </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}"
                                            name="email" id="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">Update</button>
                                </div>
                            </div>

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
