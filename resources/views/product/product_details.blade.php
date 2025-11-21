@extends('layouts.user_layout')
@section('title')
    Product Details
@endsection

@section('styles')
<style>

    /* Page Layout */
    .product-container {
        display: flex;
        gap: 40px;
        margin: 40px auto;
        max-width: 1200px;
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Image Section */
    .left-column {
        flex: 1;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #ddd;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 15px;
    }

    .left-column img {
        width: 100%;
        border-radius: 12px;
        object-fit: contain;
        max-height: 420px;
    }

    /* Right Section */
    .right-column {
        flex: 2;
        padding-top: 10px;
    }

    h1 {
        font-size: 34px;
        font-weight: 700;
    }

    h4 {
        font-size: 19px;
        color: #555;
    }

    .full-desc {
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 15px;
        color: #444;
    }

    .price {
        font-size: 30px;
        font-weight: 700;
        color: #2c3e50;
        margin-top: 5px;
        display: block;
    }

    /* Buttons */
    .cart-btn, .wishlist-btn {
        padding: 10px 25px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        transition: 0.25s;
        box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
        margin-right: 8px;
    }

    .cart-btn {
        background: #ff4733;
        color: white;
        border: none;
    }

    .cart-btn:hover {
        background: #d63725;
    }

    .wishlist-btn {
        border: 1px solid black;
        background: white;
        color: black;
    }

    .wishlist-btn:hover {
        background: black;
        color: white;
    }

    .disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

</style>
@endsection


@section('content')
@foreach ($Products as $product)
    <div class="container">

        <div class="product-container">

            <!-- Product Image -->
            <div class="left-column">

                @php
                    $imagePath = public_path('storage/images/product/' . $product->image);
                @endphp

                <img
                    src="{{ file_exists($imagePath)
                            ? asset('storage/images/product/' . $product->image)
                            : asset('images/no_image.png') }}"
                    alt="{{ $product->title }}">
            </div>


            <!-- Details Section -->
            <div class="right-column">

                <h1>{{ $product->title }}</h1>
                <h4>{{ $product->short_desc }}</h4>

                <p class="full-desc">{{ $product->full_desc }}</p>

                <span class="price">₹ {{ $product->price }}</span>

                {{-- Stock Warning --}}
                @if ($product->quantity <= 10 && $product->quantity >= 1)
                    <p class="text-danger fw-bold">Hurry! Only {{ $product->quantity }} left in stock!</p>
                @elseif ($product->quantity <= 0)
                    <p class="text-danger fw-bold">Out of Stock</p>
                @endif


                {{-- Buttons --}}
                <div class="mt-3">

                    {{-- Cart --}}
                    @if ($cartItem)
                        <a href="{{ route('cart.index') }}" class="cart-btn btn">
                            Go to Cart
                        </a>
                    @else
                        <button class="cart-btn add-to-cart {{ $product->quantity <= 0 ? 'disabled' : '' }}"
                                data-product-id="{{ $product->id }}">
                            Add to Cart
                        </button>
                    @endif


                    {{-- Wishlist --}}
                    @if ($wishlistItem)
                        <a href="{{ route('wishlist.index') }}"
                           class="wishlist-btn btn">
                           ❤️ Go To Wishlist
                        </a>
                    @else
                        @if (Auth::check())
                            <button class="wishlist-btn add-to-wishlist"
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
    Swal.fire({
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif


@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif


<script>
    $(function() {

        function isAuthenticated() {
            return {{ auth()->check() ? 'true' : 'false' }};
        }

        function redirectToLogin() {
            window.location.href = "{{ route('login') }}";
        }


        /* Add to Cart */
        $(".add-to-cart").click(function() {

            if (!isAuthenticated()) {
                redirectToLogin();
                return;
            }

            var id = $(this).data("product-id");

            $.post('/add-to-cart/' + id, {
                _token: '{{ csrf_token() }}',
            }, function(res) {

                if (res.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    window.location.href = "{{ route('cart.index') }}";
                }
            });
        });


        /* Add to Wishlist */
        $(".add-to-wishlist").click(function() {

            var id = $(this).data("product-id");

            $.post('/add-to-wishlist/' + id, {
                _token: '{{ csrf_token() }}',
            }, function(res) {

                if (res.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Wishlist',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    window.location.href = "{{ route('wishlist.index') }}";
                }

            });
        });

    });
</script>

@endsection
