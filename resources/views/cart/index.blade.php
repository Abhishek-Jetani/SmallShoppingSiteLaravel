<!-- cart/index.blade.php -->
@extends('layouts.user_layout')
@section('title')
    Cart
@endsection
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        form .error {
            color: rgb(233, 24, 24);
        }

        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            margin: 0 5px;
        }

        .product-price sup {
            font-size: smaller;
        }
    </style>
@endsection
@section('content')
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="address_form" >
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Enter Your Address</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="address_line_1">Address Line 1</label>
                            <input type="text" name="address_line_1" class="form-control" required>
                            @error('address_line_1')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address_line_2">Address Line 2 <small>(Optional)</small></label>
                            <input type="text" name="address_line_2" class="form-control">
                            @error('address_line_2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="state">State</label>
                            <select class="form-select" name="state" required>
                                <option selected disabled>Select State</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            @error('state')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city">City</label>
                            <select class="form-select" name="city" required>
                                <option selected disabled>Select City</option>
                            </select>
                            @error('city')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pincode">Pincode</label>
                            <input type="text" name="pincode" class="form-control" required>
                            @error('pincode')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mobile_no">Mobile Number</label>
                            <input type="number" name="mobile_no" class="form-control" maxlength="10" minlength="10"
                                required>
                            @error('mobile_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="submit-address-form">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div style="background-color: #f1f3f6; border: 1px solid black;" class="p-5">
        <div class="container">
            <div style="margin: 12px 45px 0 45px; border-radius:10px; background: white;">
                <h2 class="mt-3 ms-4 pt-3">Cart</h2>
                <hr>

                @forelse ($carts as $cart)
                    <div class="row" style="align-items: baseline;">
                        <div class="col-1">
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                id="delete-form-{{ $cart->id }}" class="cartform" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger me-2 ms-3 delete-btn" data-id="{{ $cart->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('product.product_detail', $cart->product->id) }}" class="text-dark"
                                style="text-decoration: none;">
                                <img src="{{ asset('storage/images/product/' . $cart->product->image) }}" width="80px"
                                    height="80px" class="rounded p-2" alt="Product Image" />
                                <label class="ms-5">{{ $cart->product->title }}</label>
                            </a>
                            @if ($cart->product->quantity <= 0)
                                <span style="margin-left: 130px; color: red;">Out of stock</span>
                            @endif
                        </div>
                        <div class="col-2">
                            <label class="mt-4"><sup class="text-secondary"><small>
                                        ₹</small></sup>{{ $cart->product->price }}</label>
                        </div>
                        <div class="col-2 quantity-controls">
                            <button class="btn btn-sm quantity-btn" data-action="minus"
                                data-cart-id="{{ $cart->id }}">-</button>
                            <input type="number" value="{{ $cart->quantity }}" class="form-control quantity-input"
                                name="quantity" data-cart-id="{{ $cart->id }}" disabled>
                            <button class="btn btn-sm quantity-btn" data-action="plus"
                                data-cart-id="{{ $cart->id }}">+</button>
                        </div>
                        <div class="col-2">
                            <label class="product-price ms-4" data-base-price="{{ $cart->product->price }}">
                                <sup class="text-secondary"><small>
                                        ₹</small></sup>{{ $cart->product->price * $cart->quantity }}
                            </label>
                        </div>
                    </div>
                @empty
                    <div class="row p-3">
                        <label class="text-center">No Product Found. <a href="{{ route('products.index') }}">Buy
                                Products</a></label>
                    </div>
                @endforelse

                @if (!$cartcount <= 0)
                    <hr>
                    <div class="row p-3" style="align-items: baseline;">
                        <div class="col-md-6" style="text-align: left;">
                            <h4>Subtotal</h4>
                        </div>
                        <div class="col-md-6" style="text-align: right; padding-right:65px;">
                            <h4 id="cart-subtotal"><sup class="text-secondary"><small> ₹</small></sup>{{ $subtotal }}
                            </h4>
                        </div>
                    </div>
                    <form action="{{ route('order.place') }}" id="address_form" method="post">
                        @csrf
                        <div class="d-flex align-items-end flex-column bd-highlight me-5 ">
                            <button class="btn btn-success mb-2" type="submit" id="place-order-button">Place
                                Order</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $().ready(function() {

            $("#address_form").validate({
                rules: {
                    address_line_1: {
                        required: true,
                        minlength: 5,
                    },
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    pincode: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    }
                },
                messages: {
                    address_line_1: {
                        required: "Address field is required",
                        minlength: "Enter at least 5 letter",
                    },
                    state: {
                        required: "State field is required",
                    },
                    city: {
                        required: "City field is required",
                    },
                    pincode: {
                        required: "Pincode field is required",
                    },
                    mobile_no: {
                        required: "Mobile number field is required",
                        minlength: "Enter 10 digit mobile number",
                        maxlength: "Enter 10 digit mobile number",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>
    {{-- city by state  --}}
    <script>
        $(document).ready(function() {
            // Load states
            $.get('/states', function(data) {
                var stateSelect = $('select[name="state"]');
                stateSelect.empty();
                stateSelect.append('<option selected disabled>Select State</option>');
                data.forEach(function(state) {
                    stateSelect.append('<option value="' + state.id + '">' + state.name +
                        '</option>');
                });
            });

            $('select[name="state"]').change(function() {
                var stateId = $(this).val();
                var citySelect = $('select[name="city"]');
                citySelect.empty();
                citySelect.append('<option selected disabled>Select City</option>');
                $.get('/cities', {
                    state_id: stateId
                }, function(data) {
                    data.forEach(function(city) {
                        citySelect.append('<option value="' + city.id + '">' + city.name +
                            '</option>');
                    });
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('#place-order-button').click(function(event) {
                let valid = true;
                $('.quantity-input').each(function() {
                    let quantity = parseInt($(this).val());
                    if (quantity < 1 || quantity > 20) {
                        valid = false;
                        Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        }).fire({
                            icon: "error",
                            title: "Product quantities must be between 1 and 20."
                        });
                        return false;
                    } else {
                        valid = true;
                        event.preventDefault();
                        $("#addressModal").modal("show");
                    }
                });

            });

            $('.quantity-btn').click(function() {
                var action = $(this).data('action');
                var input = $(this).siblings('.quantity-input');
                var quantity = input.val();
                var cartId = $(this).data('cart-id');
                var basePrice = $(this).closest('.row').find('.product-price').data('base-price');

                if (action === 'plus' && quantity < 20) {
                    quantity++;
                } else if (action === 'minus' && quantity > 1) {
                    quantity--;
                } else {
                    return;
                }

                updateCartQuantity(input, quantity, cartId, basePrice);
            });

            function updateCartQuantity(input, quantity, cartId, basePrice) {
                $.ajax({
                    type: "POST",
                    url: `/update-cart-quantity/${cartId}`,
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: quantity,
                    },
                    success: function(response) {
                        if (response.success) {
                            input.val(quantity); // Update input value
                            var productTotalPrice = quantity * basePrice;
                            input.closest('.row').find('.product-price').html(
                                `<sup  class="text-secondary"><small> ₹</small></sup>${productTotalPrice}`
                            );
                            updateSubtotal();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }

            function updateSubtotal() {
                let subtotal = 0;

                $(".product-price").each(function() {
                    let price = $(this).text().replace("₹", "");
                    subtotal += parseFloat(price);
                });
                $("#cart-subtotal").html(`<sup  class="text-secondary"><small> ₹</small></sup>${subtotal}`);
            }

            function clearErrors() {
                $(".text-danger").remove();
                $(".form-control").removeClass("is-invalid");
            }
            
            $("#address_form").submit(function(event) {
                event.preventDefault();
                clearErrors();
                var formData = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('order.place') }}",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Order Placed!",
                                text: "Your order has been placed successfully.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.href =
                                    "{{ route('order.getUserOrders') }}";
                            });
                        }

                    },
                    error: function(xhr) {
                        console.log(xhr);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                var input = $('[name="' + field + '"]');
                                input.addClass("is-invalid");
                                input.after('<div class="text-danger">' + errors[
                                        field][0] +
                                    '</div>');
                            }
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseJSON.message + (xhr
                                    .responseJSON
                                    .error ? ': ' + xhr.responseJSON
                                    .error : ''),
                                icon: "error",
                                showConfirmButton: true
                            });
                        }
                    }
                });

            });
            



        });
    </script>
@endsection
