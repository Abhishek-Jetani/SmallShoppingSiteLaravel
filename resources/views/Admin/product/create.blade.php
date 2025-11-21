@extends('layouts.admin_layout')
@section('title', 'Create Product')

@section('styles')
<style>
    .page-title {
        font-weight: 600;
        font-size: 28px;
        letter-spacing: -0.5px;
    }

    .modern-card {
        background: #fff;
        border-radius: 18px;
        padding: 24px 26px;
        border: 1px solid #e7e7e7;
        box-shadow: 0 4px 18px rgba(0,0,0,0.06);
        transition: .3s ease;
    }

    .modern-card:hover {
        box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    }

    label {
        font-weight: 500;
        margin-bottom: 4px;
    }

    .form-control,
    .form-select,
    textarea {
        border-radius: 10px;
        padding: 10px 12px;
    }

    .error {
        font-size: 13px;
        color: #d92e2e;
        font-weight: 500;
    }

    .btn-primary {
        background: #0071e3;
        border-color: #0071e3;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: #0a63c2;
        border-color: #0a63c2;
    }

    .btn-secondary {
        border-radius: 8px;
    }

</style>
@endsection

@section('content')

<h2 class="mt-4 page-title">Add Product</h2>

<section class="main mt-3">
    <div class="modern-card">

        <form action="{{ route('product.store') }}"
              id="account_info"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row pt-2">

                <!-- Title -->
                <div class="col-md-6 mb-3">
                    <label for="title">Title</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           name="title"
                           value="{{ old('title') }}">
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Short Description -->
                <div class="col-md-6 mb-3">
                    <label for="short_desc">Short Description</label>
                    <input type="text"
                           class="form-control"
                           id="short_desc"
                           name="short_desc"
                           value="{{ old('short_desc') }}">
                    @error('short_desc')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row pt-2">

                <!-- Category -->
                <div class="col-md-6 mb-3">
                    <label for="category_id">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="col-md-6 mb-3">
                    <label for="image">Product Image</label>
                    <input type="file"
                           class="form-control"
                           name="image"
                           id="image"
                           accept="image/png,image/jpg,image/jpeg,image/gif">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Full Description -->
            <div class="row pt-2">

                <div class="col-md-12 mb-3">
                    <label for="full_desc">Full Description</label>
                    <textarea class="form-control"
                              id="full_desc"
                              name="full_desc"
                              rows="4">{{ old('full_desc') }}</textarea>
                    @error('full_desc')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row pt-2">

                <!-- Status -->
                <div class="col-md-4 mb-3">
                    <label for="status">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value="">Select Status</option>
                        <option value="1">Activate</option>
                        <option value="0">Deactivate</option>
                    </select>
                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="col-md-4 mb-3">
                    <label for="price">Price</label>
                    <input type="number"
                           class="form-control"
                           id="price"
                           name="price"
                           value="{{ old('price') }}">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quantity -->
                <div class="col-md-4 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number"
                           class="form-control"
                           id="quantity"
                           name="quantity"
                           value="{{ old('quantity') }}">
                    @error('quantity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Buttons -->
            <div class="row pt-3">
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <button type="reset" class="btn btn-secondary ms-2">Reset</button>
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

    $("#account_info").validate({
        rules: {
            title: { required: true },
            short_desc: { required: true, minlength: 3 },
            category_id: { required: true },
            image: { required: true, accept: "image/jpg,image/jpeg,image/png,image/gif" },
            full_desc: { required: true, minlength: 3 },
            status: { required: true },
            price: {
                required: true,
                minlength: 1,
                maxlength: 7,
                max: 9999999,
                min: 1,
            },
            quantity: {
                required: true,
                minlength: 1,
                maxlength: 7,
                max: 9999999,
                min: 1,
            }
        },
        messages: {
            title: { required: "Title field is required" },
            short_desc: {
                required: "Short Description field is required",
                minlength: "Enter at least 3 letters",
            },
            category_id: { required: "Category field is required" },
            image: {
                required: "Image field is required",
                accept: "Image must be a file of type: png, jpg, jpeg, gif.",
            },
            full_desc: {
                required: "Full Description field is required",
                minlength: "Enter at least 3 letters",
            },
            status: { required: "Status field is required" },
            price: {
                required: "Price field is required",
                minlength: "Price should not be less than 1 character",
                maxlength: "Price should not be more than 7 characters",
                max: "Price should not exceed 9999999",
                min: "Price must be at least 1",
            },
            quantity: {
                required: "Quantity field is required",
                minlength: "Quantity should not be less than 1 character",
                maxlength: "Quantity should not be more than 7 characters",
                max: "Quantity should not exceed 9999999",
                min: "Quantity must be at least 1",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

});
</script>
@endsection
