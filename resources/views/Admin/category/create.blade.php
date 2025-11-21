@extends('layouts.admin_layout')
@section('title', 'Create Category')

@section('styles')
<style>
    .fade-in {
        animation: fadeIn 0.45s ease-in-out;
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    .card-modern {
        background: #ffffff;
        border-radius: 20px;
        border: none;
        padding: 28px;
        box-shadow: 0 6px 26px rgba(0, 0, 0, 0.08);
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px;
    }

    .btn-main {
        background: #0055b0;
        color: #fff;
        padding: 8px 18px;
        border-radius: 10px;
        transition: 0.2s;
    }
    .btn-main:hover {
        background: #054c9c;
    }

    .btn-reset {
        background: #ddd;
        padding: 8px 18px;
        border-radius: 10px;
        margin-right: 10px;
    }

    .error {
        color: #d93025;
        font-size: 0.9rem;
        margin-top: 3px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="fade-in">

    <h2 class="fw-bold mb-4">➕ Add Category</h2>

    <div class="card-modern mx-auto">

        <form action="{{ route('category.store') }}" 
              id="signupForm" 
              method="POST" 
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <!-- Title -->
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" 
                           class="form-control" 
                           id="title" 
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Enter category title">
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-md-6 mb-3">
                    <label>Description</label>
                    <input type="text" 
                           class="form-control" 
                           id="description" 
                           name="description"
                           value="{{ old('description') }}"
                           placeholder="Short description">
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-12 mb-3">
                    <label>Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Activate</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Deactivate</option>
                    </select>
                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div class="col-md-12 mb-3">
                    <label>Image</label>
                    <input type="file" 
                           class="form-control" 
                           name="image" 
                           id="image"
                           accept="image/png, image/gif, image/jpeg">
                    @error('image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="col-12 text-end">
                    <button type="reset" class="btn-reset">Reset</button>
                    <button type="submit" class="btn-main">Add Category</button>
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
$(function() {

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
            title: "Title is required",
            description: {
                required: "Description is required",
                minlength: "At least 3 characters needed",
            },
            status: "Please select a status",
            image: {
                required: "Please upload an image",
                accept: "Allowed formats: png, jpg, jpeg, gif",
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });

});
</script>
@endsection
