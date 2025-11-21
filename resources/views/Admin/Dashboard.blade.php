{{-- this is admin layout some design  --}}
{{-- https://preview.themeforest.net/item/ebazar-ecommerce-laravel-8-admin-template/full_screen_preview/37607630 --}}

@extends('layouts.admin_layout')
@section('title')
    Dashboard
@endsection

@section('styles')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
    body {
        background: #f3f4f7;
        font-family: "Inter", sans-serif;
    }

    /* Page title */
    h2 {
        font-weight: 700;
        color: #2e2e2e;
    }

    /* Stat Cards */
    .stat-card {
        border: none;
        border-radius: 16px;
        color: #fff;
        padding: 22px 18px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        transition: 0.25s;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 26px rgba(0,0,0,0.20);
    }

    .stat-icon {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 65px;
        opacity: 0.12;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
    }

    .stat-label {
        font-size: 15px;
        margin-top: 4px;
        opacity: 0.9;
    }

    .main-wrapper {
        padding: 25px;
    }

    /* Background colors */
    .bg-blue { background: linear-gradient(135deg,#2e81ff,#005df4); }
    .bg-green { background: linear-gradient(135deg,#2abf55,#13923c); }
    .bg-yellow { background: linear-gradient(135deg,#ffc94c,#d49806); }
    .bg-red { background: linear-gradient(135deg,#ff5a48,#c00f01); }

    /* Top Selling Products Table */
    .table-product img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #e4e4e4;
    }

    .table-product tbody tr {
        transition: 0.2s;
        cursor: pointer;
    }
    .table-product tbody tr:hover {
        background: #fafafa;
    }

</style>
@endsection


@section('content')

<div class="main-wrapper">
        
    <!-- Header -->
    <h2 class="mb-4">Dashboard</h2>

    <!-- Stats Row -->
    <div class="row g-4">

        <div class="col-md-3">
            <a href="{{ route('admin.manageCustomer.index') }}" class="text-decoration-none">
                <div class="stat-card bg-blue">
                    <div class="stat-value">{{ $UserCount }}</div>
                    <div class="stat-label">Customers</div>
                    <i class="fa fa-user stat-icon"></i>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('product.index') }}" class="text-decoration-none">
                <div class="stat-card bg-green">
                    <div class="stat-value">{{ $ProductCount }}</div>
                    <div class="stat-label">Products</div>
                    <i class="fa fa-product-hunt stat-icon"></i>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('category.index') }}" class="text-decoration-none">
                <div class="stat-card bg-yellow">
                    <div class="stat-value">{{ $TotalRevenue }}</div>
                    <div class="stat-label">Revenue</div>
                    <i class="fa fa-list-alt stat-icon"></i>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.usersAllOrder') }}" class="text-decoration-none">
                <div class="stat-card bg-red">
                    <div class="stat-value">{{ $OrderCount }}</div>
                    <div class="stat-label">Orders</div>
                    <i class="fa fa-shopping-cart stat-icon"></i>
                </div>
            </a>
        </div>

    </div>


    <!-- Top Selling Products -->
    @if(isset($topSellingProducts) && count($topSellingProducts) > 0)
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Top Selling Products</h4>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-product align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Sold</th>
                            <th>Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($topSellingProducts as $key => $product)
                        <tr onclick="window.location='{{ route('product.show', $product->product_id) }}'">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if(isset($product->product->image) && file_exists(public_path('storage/images/product/'.$product->product->image)))
                                    <img src="{{ asset('storage/images/product/' . $product->product->image) }}" />
                                @else
                                    <img src="https://via.placeholder.com/50x50?text=No+Img" />
                                @endif
                            </td>
                            <td>{{ $product->product->title }}</td>
                            <td>{{ $product->total_quantity }}</td>
                            <td>{{ $product->product->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @endif

</div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection
