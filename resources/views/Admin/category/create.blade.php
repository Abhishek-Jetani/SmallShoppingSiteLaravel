@extends('layouts.admin_layout')
@section('title')
    Create Category
@endsection
@section('styles')
    <style>
        .form-group {
            padding-top: 10px;
        }

        form .error {
            color: rgb(233, 24, 24);
        }

        .container {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
@section('content')
    <h2 class="mt-4">Add Category</h2>
    <section class="main">
        <div class="container pt-2" style="background: white;">
            <form action="{{ route('category.store') }}" id="signupForm" method="POST" name="registration"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="mb-2 form-control" id="title" name="title"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="mb-2 form-control" id="description" name="description"
                            value="{{ old('description') }}">
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-12">
                        <label for="status">Status </label>
                        <select class="mb-2 form-select" name="status" id="status" value=" {{ old('status') }} ">
                            <option value=""> Select status </option>
                            <option value="1"> Activate </option>
                            <option value="0">Deactivate</option>
                        </select>
                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="image">Image</label>
                        <input type="file" class="mb-2 form-control" name="image" id="image"
                            accept="image/png, image/gif, image/jpeg" value="{{ old('image') }}">
                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        <button type="submit" class=" float-end btn btn-primary">Add Category</button>
                        <button type="reset" class=" float-end btn btn-secondary me-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $().ready(function() {

            $("#signupForm").validate({

                rules: {

                    title: "required",
                    description: {
                        required: true,
                        minlength: 3,
                    },
                    status: {
                        required: true,
                    },
                    image: {
                        required: true,
                        accept: "image/jpg,image/jpeg,image/png,image/gif",
                    }
                },
                messages: {
                    title: "Title field is required",
                    description: {
                        required: "Description field is required",
                        minlength: "Enter at least 3 letter",
                    },
                    status: {
                        required: "Status field is required",
                    },
                    image: {
                        required: "Image field is required",
                        accept: "Image must be a file of type: png, jpg, jpeg.",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
