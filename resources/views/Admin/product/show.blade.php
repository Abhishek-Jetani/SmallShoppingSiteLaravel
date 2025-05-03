@extends('layouts.admin_layout')
@section('title')
    Product Details
@endsection
@section('styles')
    <style>
        .container {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">
        <h2 class="float-start">Product Details</h2>
        <a href="{{ route('product.index') }}" class="float-end btn btn-primary">Back to Products</a>
    </div><br><br>

    <section class="main">
        <div class="container pt-2 pb-2" style="background: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Title:</strong> {{ $product->title }}</p>
                    <p class="card-text"><strong>Category Name:</strong> {{ $product->category->title }}</p> <!-- Assuming you have a relationship set up -->
                    <p class="card-text"><strong>Image:</strong> <img
                            src="{{ asset('storage/images/product/' . $product->image) }}" width="50px" height="50px"
                            class="rounded" alt="product image" /></p>
                    <p class="card-text"><strong>Short Description:</strong> {{ $product->short_desc }}</p>
                    <p class="card-text"><strong>Full Description:</strong> {{ $product->full_desc }}</p>
                    <p class="card-text"><strong>Status:</strong>
                        @if ($product->status == 0)
                            <span class="badge text-bg-danger">Deactivate</span>
                        @else
                            <span class="badge text-bg-success">Activate</span>
                        @endif
                    </p>
                    <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
                    <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>
                </div>
            </div>
        </div>
    </section>
@endsection
