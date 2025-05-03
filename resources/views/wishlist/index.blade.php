@extends('layouts.user_layout')
@section('title')
    Wishlist
@endsection
@section('content')
    <div style="margin: 12px 45px 0 45px;">


        <table class="table table-bordered display" id="emp_table">
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wishlists as $wishlist)
                    <tr>
                        <td>
                            <a href="{{ route('product.product_detail', $wishlist->product->id) }}" class="text-dark"
                                style="text-decoration: none;">
                                <img src="{{ asset('storage/images/product/' . $wishlist->product->image) }}" width="50px"
                                    height="50px" class="rounded" alt="Product Image" />
                                {{ $wishlist->product->title }}
                            </a>
                        </td>
                        <td>{{ $wishlist->product->short_desc }}</td>
                        <td>
                            @if ($wishlist->product->quantity <= 10 && $wishlist->product->quantity >= 1)
                                <label class="text-danger d-inline">Hurry up </label>
                                <label class="text-danger d-inline">Only {{ $wishlist->product->quantity }} Quantity left
                                </label>
                            @elseif ($wishlist->product->quantity <= 0)
                                <label class="text-danger"><b> Out Of Stocks </b> </label>
                            @else
                                <label class="text-success">In Stock</label>
                            @endif
                        </td>



                        <td>

                            @if (in_array($wishlist->product_id, $cartItems))
                                <button class="btn btn-outline-dark">
                                    <a href="{{ route('cart.index') }}" style="text-decoration: none; color: inherit;">Go to
                                        Cart</a>
                                </button>
                            @else
                                <button
                                    class="btn btn-outline-dark add-to-cart {{ $wishlist->product->quantity <= 0 ? 'disabled' : '' }}"
                                    data-product-id="{{ $wishlist->product_id }}">
                                    Add to Cart
                                </button>
                            @endif

                            <!-- Button to delete individual wishlist item -->
                            <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Remove</button>
                            </form>
                        </td>



                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Wishlist Found. <a href="{{ route('products.index') }}">Go
                                for Shopping</a> </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection

@section('scripts')
    @if (session('success'))
        <script>
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

    <script>
        $(document).ready(function() {

            // add to cart 
            $(".add-to-cart").click(function() {
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
                            // Update the cart count
                            updateCartCount();
                            var cartUrl = "{{ route('cart.index') }}";
                            button.text("Go to Cart");
                            button.wrap("<a href='" + cartUrl + "'></a>");
                            button.off('click');
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: "success",
                                title: "product added to the cart"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding product to cart:", error);
                    }
                });
            });



        });
    </script>
@endsection
