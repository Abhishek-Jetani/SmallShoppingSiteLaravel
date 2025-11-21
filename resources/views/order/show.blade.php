{{-- order/show.blade.php  --}}

@extends('layouts.user_layout')
@section('title', 'My Orders')

@section('styles')
<style>
    .order-container {
        max-width: 1000px;
        border-radius: 12px;
        border: 1px solid #e4e4e4;
        background: #ffffff;
        padding-bottom: 10px;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
    }

    .order-header {
        padding: 18px 15px;
        border-bottom: 1px solid #ddd;
    }

    .order-row {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        transition: 0.2s;
    }

    .order-row:hover {
        background: #f6f9ff;
    }

    .order-row img {
        object-fit: cover;
        border-radius: 8px;
        height: 50px;
        width: 50px;
    }

    .no-orders-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        border: 1px solid #e4e4e4;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.08);
    }

    .order-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .order-label {
        font-weight: 600;
        font-size: 14px;
    }
</style>
@endsection


@section('content')

@if ($isOrder > 0)

<div class="container mt-4 mb-2 order-container">

    <div class="d-flex align-items-center order-header">
        <h4 class="flex-grow-1 mb-0">My Orders</h4>
        <a href="{{ route('order.user_allorder_pdf') }}" class="btn btn-primary btn-sm">
            Download PDF
        </a>
    </div>

    <div class="row mt-3 fw-bold text-secondary" style="font-size: 14px;">
        <div class="col-1"><span class="order-label">Image</span></div>
        <div class="col-4"><span class="order-label">Product</span></div>
        <div class="col-1"><span class="order-label">Qty</span></div>
        <div class="col-2"><span class="order-label">Amount</span></div>
        <div class="col-2"><span class="order-label">Order Date</span></div>
        <div class="col-2"><span class="order-label">Delivery Date</span></div>
    </div>

    @foreach ($orders as $order)
        <div class="row order-row">

            <div class="col-1">
                <img src="{{ asset('storage/images/product/' . $order->product->image) }}" alt="Product" onerror="this.onerror=null;this.src='{{ asset('images/no_image.png') }}';">
            </div>

            <div class="col-4">
                <span class="order-title">{{ $order->product->title }}</span>
            </div>

            <div class="col-1">
                <span>{{ $order->quantity }}</span>
            </div>

            <div class="col-2">
                <span>₹ {{ $order->product->price * $order->quantity }}</span>
            </div>

            <div class="col-2">
                <span>{{ $order->created_at->format('M d, Y') }}</span>
            </div>

            <div class="col-2">
                <span>{{ $order->created_at->addDays(4)->format('M d, Y') }}</span>
            </div>

        </div>
    @endforeach

</div>

@else
<div class="container mt-4">
    <div class="no-orders-card">
        <h5>No Orders Found</h5>
        <p class="text-muted">You haven't placed any orders yet.</p>
    </div>
</div>
@endif

@endsection


@section('scripts')
@if (session()->has('message'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session('message') }}"
    });
</script>
@endif
@endsection
