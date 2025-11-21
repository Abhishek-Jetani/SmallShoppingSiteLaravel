@extends('layouts.admin_layout')

@section('title')
    Product Details
@endsection

@section('styles')
    <style>
        .apple-card {
            background: #fff;
            border: 1px solid #e3e3e3;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06);
            transition: 0.3s;
        }

        .apple-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .detail-label {
            font-weight: 600;
            color: #444;
            width: 180px;
            display: inline-block;
        }

        .detail-value {
            color: #111;
        }

        .detail-row {
            margin-bottom: 12px;
        }

        .product-img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #ddd;
        }

        .btn-primary {
            border-radius: 8px;
        }

        .btn-warning {
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2 class="fw-bold mb-0">Product Details</h2>
        <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Back to Products</a>
    </div>

    <section class="main">
        <div class="container apple-card">

            {{-- Product Top Header --}}
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-semibold">{{ $product->title }}</h4>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>
            </div>

            <div class="row">

                {{-- Left Column --}}
                <div class="col-md-8">

                    <div class="detail-row">
                        <span class="detail-label">Title:</span>
                        <span class="detail-value">{{ $product->title }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Category:</span>
                        <span class="detail-value">{{ $product->category->title }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Short Description:</span>
                        <span class="detail-value">{{ $product->short_desc }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Full Description:</span>
                        <span class="detail-value">{{ $product->full_desc }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Price:</span>
                        <span class="detail-value">₹ {{ number_format($product->price) }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Quantity:</span>
                        <span class="detail-value">{{ $product->quantity }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        @if ($product->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="col-md-4 text-center">
                    <img 
                        src="{{ $product->image 
                                ? asset('storage/images/product/' . $product->image) 
                                : 'https://placehold.co/300x300?text=No+Image' 
                            }}"
                        class="product-img mb-2"
                        alt="Product Image">

                    <p class="text-muted">Product Image</p>
                </div>

            </div>

        </div>
    </section>

@endsection
