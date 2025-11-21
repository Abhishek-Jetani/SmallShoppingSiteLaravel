@extends('layouts.admin_layout')

@section('title', 'Edit Category')

@section('styles')
<style>
    .page-title {
        font-weight: 600;
        font-size: 28px;
        letter-spacing: -0.5px;
    }

    .card-modern {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e7e7e7;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }

    .card-modern:hover {
        box-shadow: 0px 8px 24px rgba(0,0,0,0.08);
    }

    label {
        font-weight: 500;
        margin-top: 8px;
    }

    .image-preview {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f7f7f7;
        margin-top: 8px;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    button {
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary {
        background: #0071e3;
        border-color: #0071e3;
    }

    .btn-primary:hover {
        background: #0a64c2;
        border-color: #0a64c2;
    }

    .form-control {
        border-radius: 10px;
        height: 46px;
    }

    .error {
        color: red;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<h2 class="mt-4 page-title">Edit Category</h2>

<section class="main">
    <div class="container mt-3">
        <div class="card-modern">

            <form action="{{ route('category.update', $category->id) }}" id="myForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control"
                               name="title" value="{{ $category->title }}"
                               placeholder="Enter category title">
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label>Description</label>
                        <input type="text" class="form-control"
                               name="description"
                               value="{{ $category->description }}"
                               placeholder="Enter category description">
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-12 mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Deactivate</option>
                        </select>
                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-12 mb-4">
                        <label>Category Image</label>
                        <input type="file" name="image" class="form-control"
                               accept=".png,.jpg,.jpeg">

                        <div class="image-preview">
                            @if($category->image)
                                <img src="{{ asset('storage/images/category/' . $category->image) }}" alt="Category Image">
                            @else
                                <img src="https://via.placeholder.com/120?text=No+Image" alt="Default Image">
                            @endif
                        </div>

                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 text-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>

    $().ready(function () {
        $("#myForm").validate({
            rules: {
                title: "required",
                description: { required: true, minlength: 3 },
                status: { required: true },
                image: { accept: "image/jpg,image/jpeg,image/png" }
            },
            messages: {
                title: "Title is required",
                description: {
                    required: "Description is required",
                    minlength: "Enter at least 3 letters",
                },
                status: "Status is required",
                image: "Only png, jpg, jpeg allowed"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

</script>
@endsection
