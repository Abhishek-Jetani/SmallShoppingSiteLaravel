{{-- order/show.blade.php  --}}

@extends('layouts.user_layout')
@section('title')
    Order
@endsection
@section('styles')
    <style>
        .row label {
            font-weight: 600;
        }
    </style>
@endsection
@section('content')





    @if ($isOrder > 0)
        <div class="container mt-4  mb-2 pb-4" style="max-width: 1000px; border-radius:10px; border:1px solid rgb(0, 0, 0)">

            <div class="d-flex bd-highlight">
                <h4 class="mt-3 flex-grow-1 bd-highlight">My Orders</h4>
                <a href="{{ route('order.user_allorder_pdf') }}" class="mt-3 bd-highlight btn btn-primary">
                    Download
                </a>
            </div>
            <hr>

            <div class="row pt-2" style="align-items: baseline;">

                <div class="col-1">
                    <label class=" mb-3">Image</label>
                </div>
                <div class="col-4">
                    <label class=" mb-3">Product Name</label>
                </div>
                <div class="col-1">
                    <label class=" mb-3">Quantity</label>
                </div>
                <div class="col-2">
                    <label class=" mb-3">Amount</label>
                </div>
                <div class="col-2">
                    <label class=" mb-3">Order Date</label>
                </div>
                <div class="col-2">
                    <label class=" mb-3">Delivery Date</label>
                </div>
                <hr>



                @foreach ($orders as $order)
                    <div class="col-1">

                        <div style="max-height: 50px !important; min-height: 50px !important;  max-width:50px;">
                            <img src="{{ asset('storage/images/product/' . $order->product->image) }}"
                                class="card-img-top mt-2" alt="product image"
                                style="object-fit: fill;  border-radius:10px; max-height: 50px !important; min-height: 50px !important;">
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="ms-2">
                            <p> {{ $order->product->title }}</p>
                        </div>
                    </div>
                    <div class="col-1">
                        <p>{{ $order->quantity }}</p>
                    </div>
                    <div class="col-2">
                        <p>₹ {{ $order->product->price * $order->quantity }}</p>
                    </div>
                    <div class="col-2">
                        <p>{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="col-2">
                        <p>{{ $order->created_at->addDays(4)->format('M d, Y') }}</p>
                    </div>
                @endforeach
            </div>


        </div>
    @else
        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No Orders Found</h5>
                        </div>
                    </div>
                </div>
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
