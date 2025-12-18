@extends('layouts.user_layout')
@section('title', 'Wishlist')

@section('content')

<style>
    .wishlist-card {
        border: none;
        border-radius: 18px;
        transition: 0.25s;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0px 4px 20px rgba(0,0,0,0.08);
    }
    .wishlist-card:hover {
        transform: translateY(-4px);
        box-shadow: 0px 6px 25px rgba(0,0,0,0.15);
    }
    .wishlist-img {
        width: 100%;
        max-width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #ddd;
    }
    .btn-soft-dark {
        background: #111;
        color: #fff;
        border-radius: 40px;
        padding: 6px 20px;
        transition: 0.2s;
    }
    .btn-soft-dark:hover {
        background: #000;
        color: #fff;
    }
    .badge-custom {
        font-size: 13px;
        padding: 6px 10px;
        border-radius: 10px;
    }
</style>

<div class="container py-5">

    <h2 class="fw-bold mb-4">❤️ My Wishlist</h2>

    @forelse ($wishlists as $wishlist)

        <div class="wishlist-card p-4 mb-3">

            <div class="d-flex align-items-center">

                <!-- Product Image + Fallback -->
                <img src="{{ asset('storage/images/product/' . $wishlist->product->image) }}"
                     onerror="this.src='{{ asset('images/no_image.png') }}'"
                     class="wishlist-img me-4">

                <div class="flex-grow-1">

                    <!-- Product Title -->
                    <h5 class="mb-1">
                        <a href="{{ route('product.product_detail', $wishlist->product->id) }}"
                           class="text-dark text-decoration-none">
                            {{ $wishlist->product->title }}
                        </a>
                    </h5>

                    <!-- Short Description -->
                    <p class="text-muted mb-2">
                        {{ $wishlist->product->short_desc }}
                    </p>

                    <!-- Stock Status -->
                    @if ($wishlist->product->quantity <= 10 && $wishlist->product->quantity >= 1)
                        <span class="badge bg-warning text-dark badge-custom">
                            Hurry! Only {{ $wishlist->product->quantity }} left
                        </span>
                    @elseif ($wishlist->product->quantity <= 0)
                        <span class="badge bg-danger badge-custom">Out of Stock</span>
                    @else
                        <span class="badge bg-success badge-custom">In Stock</span>
                    @endif

                </div>

                <!-- Action Buttons -->
                <div class="text-end">

                    @if (in_array($wishlist->product_id, $cartItems))
                        <a href="{{ route('cart.index') }}"
                           class="btn btn-outline-dark rounded-pill mb-2">
                            Go to Cart
                        </a>
                    @else
                        <button
                            class="btn btn-soft-dark add-to-cart mb-2 rounded-pill 
                            {{ $wishlist->product->quantity <= 0 ? 'disabled opacity-50' : '' }}"
                            data-product-id="{{ $wishlist->product_id }}">
                            Add to Cart
                        </button>
                    @endif

                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger rounded-pill w-100">
                            Remove
                        </button>
                    </form>

                </div>

            </div>
        </div>

    @empty

        <!-- If empty -->
        <div class="text-center py-5">
            
            <h4 class="mb-2">Your Wishlist Is Empty</h4>
            <a href="{{ route('products.index') }}"
               class="btn btn-dark rounded-pill px-4">
               Browse Products
            </a>
        </div>

    @endforelse

</div>

@endsection


@section('scripts')

@if (session('success'))
<script>
Swal.fire({
    toast: true,
    position: "top-end",
    icon: "success",
    title: "{{ session('success') }}",
    timer: 2500,
    showConfirmButton: false
});
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    title: "Error!",
    text: "{{ session('error') }}",
    icon: "error",
    timer: 3000,
    showConfirmButton: false
});
</script>
@endif

<script>
$(document).ready(function () {

    $(".add-to-cart").click(function () {
        var productId = $(this).data("product-id");
        var token = '{{ csrf_token() }}';
        var button = $(this);

        $.ajax({
            type: "POST",
            url: "/add-to-cart/" + productId,
            data: { _token: token },
            success: function (response) {

                updateCartCount();

                let cartUrl = "{{ route('cart.index') }}";
                button.text("Go to Cart");
                button.wrap("<a href='" + cartUrl + "'></a>");
                button.off();

                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Added to Cart",
                    timer: 2500,
                    showConfirmButton: false
                });
            }
        });
    });

});
</script>

@endsection
