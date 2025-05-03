{{-- products/all_products.blade.php  --}}

@extends('layouts.user_layout')
@section('title')
    All Products
@endsection
@section('content')
    <div class="row pt-2 m-2" style="margin: 0;padding:0;">
        @foreach ($products as $product)
            <div class="col-sm-2 ">
                <div class="card mt-3 p-2">
                    <a href="{{ route('product.product_detail', $product->id) }}" style="color:black; text-decoration:none;">
                        <img src="{{ asset('storage/images/product/' . $product->image) }}" alt="" height="150" width="100%">
                        <p> {{ $product->title }} </p>
                        <p> {{ $product->created_at }} </p>
                        <h5> {{ $product->price }}₹ </h5>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
