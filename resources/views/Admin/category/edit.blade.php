@extends('layouts.admin_layout')
@section('title')
    Edit Category
@endsection
@section('styles')
    <style>
        form .error {
            color: red;
        }

        .container {
            box-shadow: rgba(124, 124, 136, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
@section('content')
    <h2 class="mt-4">Edit Category</h2>
    <section class="main">
        <div class="container pt-2" style="background: white;">
            <form action="{{ route('category.update', $category->id) }}" id="myForm" method="POST"
                name="register"user enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" class="mb-2 form-control" id="title" name="title"
                            placeholder="Enter category title" value="{{ $category->title }}">
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="description">Description</label>
                        <input type="text" class="mb-2 form-control" id="description" name="description"
                            placeholder="Enter category description" value="{{ $category->description }}">
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="status">Status </label>
                        <select class="mb-2 form-control" name="status" id="status" value=" {{ old('status') }} ">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Deactivate</option>
                        </select>
                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="image">Image</label><br>
                        <input type="file" class="mb-2 form-control" name="image" id="image"
                            accept=".png, .jpg, .jpeg">
                        @if ($category->image)

                            <img src="{{ asset('storage/images/category/' . $category->image) }}" alt="Category Image"
                                style="max-width: 100px; margin-bottom: 10px;" class="d-block"><br>
                        @endif
                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-2">
                        <button type="submit" class=" float-end btn btn-primary">Update Category</button>
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

            $("#myForm").validate({

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
