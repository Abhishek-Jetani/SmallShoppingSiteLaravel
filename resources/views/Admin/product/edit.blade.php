@extends('layouts.admin_layout')
@section('title')
    Edit Products
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
    <h2 class="mt-4">Edit Product</h2>
    <section class="main">
        <div class="container pt-2" style="background: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <form action="{{ route('product.update', $product->id) }}" id="myForm" method="POST" name="register"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row pt-2">
                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="mb-2 form-control" id="title" name="title"
                            placeholder="Enter category title" value="{{ $product->title }}">
                        @error('title')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="exampleInputEmail1">Short description</label>
                        <input type="text" class="mb-2 form-control" id="short_desc" name="short_desc"
                            placeholder="Enter product short description" value="{{ $product->short_desc }}">
                        @error('short_desc')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-12 form-group">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->title }} </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-12 form-group">
                        <label for="image" class="d-block">Image</label>
                        <input type="file" class="mb-2 form-control" name="image" id="image"
                            accept=".png, .jpg, .jpeg" value="{{ $product->image }}">
                        <img src="{{ asset('storage/images/product/' . $product->image) }}" width="50px" height="50px"
                            class="rounded mb-1" alt="abcd" title="" />
                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-12 form-group">
                        <label for="full_desc">Full description</label>
                        <textarea class="form-control" name="full_desc" id="full_desc" rows="3"> {{ $product->full_desc }} </textarea>
                        @error('full_desc')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row pt-3">

                    <div class="col-md-4 form-group">
                        <label for="status">Status </label>
                        <select class="mb-2 form-select" name="status" id="status">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Deactivate</option>
                        </select>
                        @error('status')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" class="mb-2 form-control" id="price" name="price"
                            placeholder="Enter product price" value="{{ $product->price }}">
                        @error('price')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" class="mb-2 form-control" id="quantity" name="quantity"
                            placeholder="Enter product quantity" value="{{ $product->quantity }}">
                        @error('quantity')
                            <div class="error text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row pt-2">
                    <div class="col-12 mb-2">
                        <button type="submit" class=" float-end btn btn-primary">Update Product</button>
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
                    title: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                        minlength: 3,
                    },
                    category_id: {
                        required: true,
                    },
                    image: {
                        accept: "image/jpg,image/jpeg,image/png,image/gif",
                    },
                    full_desc: {
                        required: true,
                        minlength: 3,
                    },
                    status: {
                        required: true,
                    },
                    price: {
                        required: true,
                        minlength: 1,
                        maxlength: 7,
                        max: 9999999,
                        min:1,
                    },
                    quantity: {
                        required: true,
                        minlength: 1,
                        maxlength: 7,
                        max: 9999999,
                        min:1,
                    }
                },
                messages: {
                    title: {
                        required: "Title is required",
                    },
                    short_desc: {
                        required: "Short Description is required",
                        minlength: "Enter at least 3 letter",
                    },
                    category_id: {
                        required: "Category is required",
                    },
                    image: {
                        accept: "Image must be a file of type: png, jpg, jpeg.",
                    },
                    full_desc: {
                        required: "Full Description is required",
                        minlength: "Enter at least 3 letter",
                    },
                    status: {
                        required: "Status is required",
                    },
                    price: {
                        required: "Price is required",
                        minlength: "Price should not be greater than 1 character",
                        maxlength: "Quantity should be at least 7 character long",
                        max: "Price should not be greater than 9999999",
                        min: "Price should not be less than 1",
                    },
                    quantity: {
                        required: "Quantity is required",
                        minlength: "Quantity should not be greater than 1 character",
                        maxlength: "Quantity should be at least 7 character long",
                        max: "Price should not be greater than 9999999",
                        min: "Price should not be less than 1",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>
@endsection
