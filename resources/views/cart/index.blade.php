<!-- cart/index.blade.php -->
@extends('layouts.user_layout')

@section('title')
    Cart
@endsection

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Apple Minimal Feel */
    body {
        background: #f7f9fb;
        font-family: "SF Pro Display", "Segoe UI", sans-serif;
    }

    h2, h4 {
        font-weight: 600;
        letter-spacing: -0.3px;
    }

    /* Cart Container */
    .cart-wrapper {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.06);
        padding: 25px 30px;
        margin-top: 40px;
        transition: 0.3s;
    }

    /* Cart item */
    .cart-item {
        padding: 18px 5px;
        border-bottom: 1px solid #ececec;
        transition: 0.25s;
        border-radius: 8px;
    }

    .cart-item:hover {
        background: #f9f9f9;
        transform: scale(1.01);
    }

    .cart-product-img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #ddd;
        background: white;
    }

    .delete-btn {
        background: #ff4d4f !important;
        border-radius: 8px;
        padding: 6px 10px;
        transition: 0.2s;
    }

    .delete-btn:hover {
        background: #e02527 !important;
    }

    /* Quantity controls */
    .quantity-btn {
        background: #e7e7e7;
        border-radius: 6px;
        width: 30px;
    }

    .quantity-input {
        max-width: 60px;
        text-align: center;
        border-radius: 6px;
    }

    /* Price section */
    .subtotal-box {
        padding: 18px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    /* Checkout */
    #place-order-button {
        padding: 12px 26px;
        border-radius: 12px;
        background: #171717;
        border: none;
        transition: 0.25s;
        color: #fff;
    }

    #place-order-button:hover {
        background: #000;
        transform: scale(1.04);
    }

    /* Modal form styling */
    .modal-content {
        border-radius: 14px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    }

    .modal-title {
        font-weight: 600;
    }
</style>
@endsection



@section('content')

{{-- Address Modal --}}
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="address_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Enter Your Address</h5>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="mb-3">
                        <label>Address Line 1</label>
                        <input type="text" name="address_line_1" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Address Line 2 (Optional)</label>
                        <input type="text" name="address_line_2" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>State</label>
                        <select class="form-select" name="state" required>
                            <option selected disabled>Select State</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>City</label>
                        <select class="form-select" name="city" required>
                            <option selected disabled>Select City</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Pincode</label>
                        <input type="text" name="pincode" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Mobile Number</label>
                        <input type="number" name="mobile_no" class="form-control"
                               minlength="10" maxlength="10" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-dark"
                            style="border-radius:10px;">
                        Place Order
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>





{{-- Cart Section --}}
<div class="container">
    <div class="cart-wrapper">

        <h2>🛒 My Cart</h2>
        <hr>

        @forelse ($carts as $cart)

            <div class="row cart-item align-items-center">

                {{-- Delete Button --}}
                <div class="col-1">
                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                        id="delete-form-{{ $cart->id }}" class="cartform" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger delete-btn" data-id="{{ $cart->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>

                {{-- Product --}}
                <div class="col-md-5">
                    <a href="{{ route('product.product_detail', $cart->product->id) }}" class="text-dark"
                        style="text-decoration: none;">

                        <img 
                            src="{{ $cart->product->image 
                                ? asset('storage/images/product/' . $cart->product->image) 
                                : asset('images/no_image.png') }}" 
                            class="cart-product-img"
                            alt="{{ $cart->product->title }}"
                            onerror="this.src='{{ asset('images/no_image.png') }}'"
                        />

                        <label class="ms-3 me-4">{{ $cart->product->title }}</label>
                    </a>

                    @if ($cart->product->quantity <= 0)
                        <span style="color: red; font-size:14px;">Out of stock</span>
                    @endif
                </div>


                {{-- Price --}}
                <div class="col-md-2">
                    <label>
                        <sup class="text-secondary"><small>₹</small></sup>
                        {{ $cart->product->price }}
                    </label>
                </div>


                {{-- Quantity --}}
                <div class="col-md-2">

                    <button class="btn btn-sm quantity-btn"
                            data-action="minus"
                            data-cart-id="{{ $cart->id }}">-</button>

                    <input type="number"
                           value="{{ $cart->quantity }}"
                           class="form-control quantity-input d-inline"
                           name="quantity"
                           data-cart-id="{{ $cart->id }}"
                           disabled>

                    <button class="btn btn-sm quantity-btn"
                            data-action="plus"
                            data-cart-id="{{ $cart->id }}">+</button>
                </div>


                {{-- Total for item --}}
                <div class="col-md-2">
                    <label class="product-price"
                        data-base-price="{{ $cart->product->price }}">
                        <sup class="text-secondary"><small>₹</small></sup>
                        {{ $cart->product->price * $cart->quantity }}
                    </label>
                </div>

            </div>

        @empty

            <div class="text-center p-4">
                <strong>No items found.</strong><br>
                <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Browse Products</a>
            </div>

        @endforelse


        {{-- Subtotal --}}
        @if (!$cartcount <= 0)
            <hr>
            <div class="row mt-3 mb-3">
                <div class="col-md-6">
                    <h4>Total</h4>
                </div>
                <div class="col-md-6 text-end pe-4">
                    <h4 id="cart-subtotal">
                        <sup class="text-secondary"><small>₹</small></sup>{{ $subtotal }}
                    </h4>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-dark" id="place-order-button">
                    Proceed to Checkout
                </button>
            </div>
        @endif

    </div>
</div>

@endsection





@section('scripts')

{{-- jQuery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- jQuery Validation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


<script>
$(document).ready(function() {

    /* -------------------------
        Validate address form
    ------------------------- */
    $("#address_form").validate({
        rules: {
            address_line_1: { required: true, minlength: 5 },
            state: { required: true },
            city: { required: true },
            pincode: { required: true },
            mobile_no: { required: true, minlength: 10, maxlength: 10 },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


    /* -------------------------
        Load States & Cities
    ------------------------- */
    $.get('/states', function(data) {
        var stateSelect = $('select[name="state"]');
        stateSelect.append('<option selected disabled>Select State</option>');
        data.forEach(function(state) {
            stateSelect.append('<option value="'+state.id+'">'+state.name+'</option>');
        });
    });


    $('select[name="state"]').change(function() {
        var stateId = $(this).val();
        var citySelect = $('select[name="city"]');
        citySelect.empty();
        citySelect.append('<option selected disabled>Select City</option>');

        $.get('/cities', { state_id: stateId }, function(data) {
            data.forEach(function(city) {
                citySelect.append('<option value="'+city.id+'">'+city.name+'</option>');
            });
        });
    });



    /* -------------------------
        Show modal before checkout
    ------------------------- */
    $('#place-order-button').click(function(event) {

        let valid = true;

        $('.quantity-input').each(function() {
            let qty = parseInt($(this).val());
            if (qty < 1 || qty > 20) {
                valid = false;
                Swal.fire({
                    icon: "error",
                    title: "Quantity must be between 1 and 20.",
                });
                return false;
            }
        });

        if (valid) {
            event.preventDefault();
            $("#addressModal").modal("show");
        }
    });



    /* -------------------------
        Update Quantity AJAX
    ------------------------- */
    $('.quantity-btn').click(function() {

        var action   = $(this).data('action');
        var input    = $(this).siblings('.quantity-input');
        var qty      = parseInt(input.val());
        var cartId   = $(this).data('cart-id');
        var unitPrice = $(this).closest('.row').find('.product-price').data('base-price');

        if (action === 'plus' && qty < 20) qty++;
        else if (action === 'minus' && qty > 1) qty--;
        else return;

        updateCartQuantity(input, qty, cartId, unitPrice);
    });


    function updateCartQuantity(input, qty, cartId, price) {

        $.ajax({
            type: "POST",
            url: `/update-cart-quantity/${cartId}`,
            data: {
                _token: "{{ csrf_token() }}",
                quantity: qty,
            },
            success: function(response) {

                input.val(qty);

                var total = qty * price;

                input.closest('.row')
                .find('.product-price')
                .html(`<sup><small>₹</small></sup>${total}`);

                updateSubtotal();
            }
        });
    }


    function updateSubtotal() {

        let subtotal = 0;

        $(".product-price").each(function() {
            subtotal += parseFloat($(this).text().replace("₹", ""));
        });

        $("#cart-subtotal").html(`<sup><small>₹</small></sup>${subtotal}`);
    }

});
</script>
@endsection
