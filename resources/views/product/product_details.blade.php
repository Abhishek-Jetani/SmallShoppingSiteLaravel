{{-- products/product_details.blade.php  --}}

@extends('layouts.user_layout')
@section('title')
    Product Details
@endsection

@section('styles')
    <style>
        .product-container {
            display: flex;
            margin: 10px 80px 20px 80px;
        }

        .left-column {
            flex: 1;
            margin-right: 20px;
            max-height: 500px;
            min-height: 250px;
            border: 2px solid #bbb;
            padding: 10px;
            border-radius: 15px;
        }

        .left-column img {
            width: 100%;
            height: auto;
            object-fit: fill;
            border-radius: 15px;
        }


        .right-column {
            flex: 2;
        }

        .product-description {
            margin-bottom: 10px;
        }

        .category {
            font-weight: bold;
            font-size: 18px;
        }

        .product-description h1 {
            font-size: 40px;
        }

        .product-description h4 {
            font-size: 20px;
        }

        .full-desc {
            max-height: 100px;
            overflow: hidden;
            font-size: 16px;
        }


        .read-more {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: blue;
            font-size: 16px;
        }

        .status {
            margin-right: 10px;
        }

        .text-green {
            color: green;
        }

        .text-danger {
            color: red;
        }

        .cart-btn {
            background-color: rgb(255, 47, 0);
            color: white;
        }

        .cart-btn:hover {
            background-color: rgb(208, 44, 7);
            color: white;
        }

        .wishlist-btn {
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            padding: 8px 12px;
            border: 1px solid black;
            border-radius: 10px;
            margin: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
            width: 150px;
        }

        .wishlist-btn:hover {
            text-decoration: none;
            color: white;
            background: black;
        }


        .price {
            font-size: 26px;
            font-weight: 500;
        }

        .disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        #quantity-error {
            color: red;
            display: block;
        }
    </style>
@endsection
@section('content')
    @foreach ($Products as $product)
        <div class="container">
            <div class="product-container">
                <!-- Left Column / Headphones Image -->
                <div class="left-column">
                    <img data-image="red" class="active" src="{{ asset('storage/images/product/' . $product->image) }}"
                        style="max-height: 350px; min-height: 350px;" alt="product">
                </div>

                <!-- Right Column -->
                <div class="right-column">
                    <!-- Product Description -->
                    <div class="product-description pt-3">
                        <h1>{{ $product->title }}</h1>
                        <h4>{{ $product->short_desc }}</h4>
                        <p class="full-desc">{{ $product->full_desc }}</p>
                        <span class="price" id="base-price">{{ $product->price }}</span>
                    </div>


                    @if ($product->quantity <= 10 && $product->quantity >= 1)
                        <h5 class="text-danger d-inline">Hurry up </h5>
                        <h5 class="text-danger d-inline">Only {{ $product->quantity }} Quantity left</h5>
                    @elseif ($product->quantity <= 0)
                        <h5 class="text-danger">Out Of Stocks</h5>
                    @endif




                    <div class="product-actions">
                        @if ($cartItem)
                            <a href="{{ route('cart.index') }}" class="btn cart-btn">
                                Go to cart
                            </a>
                        @else
                            <button class="ms-1 btn add-to-cart cart-btn {{ $product->quantity <= 0 ? 'disabled' : '' }}"
                                data-product-id="{{ $product->id }}">
                                Add to Cart
                            </button>
                        @endif


                        @if ($wishlistItem)
                            <a href="{{ route('wishlist.index') }}" class="btn btn-outline-dark">
                                <i style="color: red;" class="fa fa-heart"></i> Go To Wishlist
                            </a>
                        @else
                            @if (Auth::check())
                                <button class="add-to-wishlist ms-1 btn btn-outline-dark"
                                    data-product-id="{{ $product->id }}">
                                    Add to Wishlist
                                </button>
                            @endif
                        @endif

                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    @if (session('success'))
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
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 3000,
            });
        </script>
    @endif
    {{-- validation  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {

            function isAuthenticated() {
                return {{ auth()->check() ? 'true' : 'false' }};
            }

            function redirectToLogin() {
                window.location.href = "{{ route('login') }}";
            }

            // add to cart 
            $(".add-to-cart").click(function() {

                if (!isAuthenticated()) {
                    redirectToLogin();
                    return;
                }

                var productId = $(this).data("product-id");
                var csrfToken = '{{ csrf_token() }}';
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: '/add-to-cart/' + productId,
                    data: {
                        _token: csrfToken,
                    },
                    success: function(response) {
                        if (response.success) {
                            // show toast
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
                                title: "Product added to the cart successfully"
                            });

                            var cartUrl = "{{ route('cart.index') }}";
                            button.text("Go to Cart");
                            button.wrap("<a href='" + cartUrl + "'></a>");
                            button.off('click');

                            // Update the cart count
                            updateCartCount();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding product to cart:", error);
                    }
                });
            });







            // add to wishlist
            $(".add-to-wishlist").click(function() {
                var productId = $(this).data("product-id");
                var csrfToken = '{{ csrf_token() }}';
                var button = $(this);

                $.ajax({
                    type: 'POST',
                    url: '/add-to-wishlist/' + productId,
                    data: {
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.success) {

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Product added in wishlist",
                            });

                            var wishlistUrl = "{{ route('wishlist.index') }}";
                            button.text("Go to Wishlist");
                            button.off("click");
                            button.wrap("<a href='" + wishlistUrl +
                                "'></a>");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding product to wishlist:", error);
                    }
                });
            });

        });
    </script>
@endsection
