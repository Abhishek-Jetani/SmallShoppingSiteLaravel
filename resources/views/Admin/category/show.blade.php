@extends('layouts.admin_layout')
@section('title', 'Category Details')

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
        padding: 24px 22px;
        border: 1px solid #e7e7e7;
        box-shadow: 0 4px 18px rgba(0,0,0,0.06);
        transition: .3s ease;
    }

    .modern-card:hover {
        box-shadow: 0 8px 28px rgba(0,0,0,0.10);
    }

    label, p {
        font-size: 15px;
        margin: 6px 0;
    }

    .image-box {
        width: 120px;
        height: 120px;
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid #ddd;
        background: #f4f4f4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-primary {
        background: #0071e3;
        border-color: #0071e3;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: #0a64c2;
        border-color: #0a64c2;
    }

</style>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mt-4">
    <h2 class="page-title">Category Details</h2>
    <a href="{{ route('category.index') }}" class="btn btn-primary">
        Back to Category
    </a>
</div>

<section class="main mt-4">
    <div class="container p-0">
        <div class="modern-card">

            <div class="row">

                <!-- Title -->
                <div class="col-md-6 mb-3">
                    <p><strong>Title:</strong> {{ $category->title }}</p>
                </div>

                <!-- Description -->
                <div class="col-md-6 mb-3">
                    <p><strong>Description:</strong> {{ $category->description }}</p>
                </div>

                <!-- Image -->
                <div class="col-md-6 mb-4">
                    <p><strong>Image:</strong></p>
                    <div class="image-box">
                        @if($category->image)
                            <img src="{{ asset('storage/images/category/' . $category->image) }}" alt="Category Image" onerror="this.onerror=null;this.src='{{ asset('images/no_image.png') }}';">
                        @else
                            <img src="{{ asset('images/no_image.png') }}" alt="Default">
                        @endif
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                    <p><strong>Status:</strong>
                        @if ($category->status == 0)
                            <span class="badge bg-danger">Deactivated</span>
                        @else
                            <span class="badge bg-success">Active</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
