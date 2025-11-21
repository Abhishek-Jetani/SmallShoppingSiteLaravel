@extends('layouts.admin_layout')

@section('title')
    Edit Product
@endsection

@section('styles')
    <style>
        .apple-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            border: 1px solid #eaeaea;
            box-shadow: 0 4px 14px rgba(0,0,0,0.05);
            transition: 0.3s ease;
        }

        .apple-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        label {
            font-weight: 600;
        }

        input, select, textarea {
            border-radius: 10px !important;
            transition: 0.15s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #0071e3 !important;
            box-shadow: 0 0 0 2px rgba(0,113,227,0.2) !important;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .btn-primary {
            background: #0071e3;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background: #005bbd;
        }

        .preview-img {
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2 class="mb-0 fw-bold">Edit Product</h2>
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    <section class="main">
        <div class="container apple-card">
            <form action="{{ route('product.update', $product->id) }}" id="myForm"
                method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ $product->title }}" placeholder="Product title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Short Description</label>
                        <input type="text" class="form-control" name="short_desc"
                            value="{{ $product->short_desc }}" placeholder="Short description">
                        @error('short_desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg">
                    
                    <div class="mt-2">
                        <img src="{{ $product->image 
                                ? asset('storage/images/product/' . $product->image) 
                                : 'https://placehold.co/80x80?text=No+Image' 
                            }}"
                            class="preview-img" alt="Product">
                    </div>

                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Full Description</label>
                    <textarea class="form-control" name="full_desc" rows="3">{{ $product->full_desc }}</textarea>
                    @error('full_desc')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="row">

                    <div class="col-md-4 form-group">
                        <label>Status</label>
                        <select class="form-select" name="status">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Activate</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Deactivate</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price"
                            value="{{ $product->price }}" placeholder="Price">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity"
                            value="{{ $product->quantity }}" placeholder="Quantity">
                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="pt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Update Product
                    </button>
                </div>

            </form>
        </div>
    </section>

@endsection
