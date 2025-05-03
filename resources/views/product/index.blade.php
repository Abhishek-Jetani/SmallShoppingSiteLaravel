{{-- products/index.blade.php  --}}

@extends('layouts.user_layout')
@section('title')
    Products
@endsection
@section('styles')
    <style>
        .dropdown-wrapper {
            position: relative;
        }

        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.2s;
        }

        .dropdown-arrow::before {
            content: '\25BC';
        }

        .open .dropdown-arrow::before {
            content: '\25B2';
        }
    </style>
@endsection
@section('content')
    <div style="background: #dbd9d9;">
        <div class="p-3">
            <div class="row mt-2 mb-4 ms-1 me-1 pt-2 pb-3 rounded" style="background: white;">
                <div class="col-10">
                    <div class="form-group">
                        <label for="categoryDropdown" class="mt-2">Select Category:</label>
                        <div class="dropdown-wrapper">
                            <select id="categoryDropdown" class="form-control mt-2">
                                <option value="">All Products</option>
                                @foreach ($categories as $category)
                                    @if ($category->status == 1)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="dropdown-arrow"></span>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group mt-2">
                        <label for="sortDropdown">Sort by Price:</label>
                        <div class="dropdown-wrapper">
                            <select id="sortDropdown" class="form-control mt-2">
                                <option value="">Default</option>
                                <option value="asc">Low to High</option>
                                <option value="desc">High to Low</option>
                            </select>
                            <span class="dropdown-arrow"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products List -->
            <div class="row" id="productList">
                @foreach ($products as $product)
                    <div class="col-sm-3 mb-4">
                        <div class="card" style="max-height:530px; min-height:530px;">
                            <a href="{{ route('product.product_detail', $product->id) }}"
                                style="color:black; text-decoration:none;">
                                <img src="{{ asset('storage/images/product/' . $product->image) }}" class="card-img-top p-2"
                                    alt="product image" style="max-height:350px; min-height:350px;">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="overflow: hidden;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;">
                                        {{ $product->title }}</h5>
                                    <p class="card-text"
                                        style="overflow: hidden;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;">
                                        {{ $product->short_desc }}</p>
                                    <p class="card-text"><sup> ₹</sup><b style="font-size:25px;">{{ $product->price }}</b>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    {{-- drop down  --}}
    <script>
        document.querySelectorAll('.dropdown-wrapper').forEach((wrapper) => {
            const select = wrapper.querySelector('select');

            select.addEventListener('click', () => {
                wrapper.classList.toggle('open');
            });

            document.addEventListener('click', (e) => {
                if (!wrapper.contains(e.target)) {
                    wrapper.classList.remove('open');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#categoryDropdown, #sortDropdown').change(function() {
                var categoryId = $('#categoryDropdown').val();
                var sortBy = $('#sortDropdown').val();
                var data = {
                    _token: '{{ csrf_token() }}',
                    sort_by: sortBy
                };

                if (categoryId) {
                    data.category_id = categoryId;
                }

                $.ajax({
                    url: categoryId ? '{{ route('products.byCategory') }}' :
                        '{{ route('products.all') }}',
                    type: 'POST',
                    data: data,
                    success: function(products) {
                        var productHtml = '';
                        if (products.length > 0) {
                            products.forEach(function(product) {
                                productHtml += `
                                <div class="col-sm-3  mb-4">
                                    <div class="card" style="max-height:530px; min-height:530px;">
                                        <a href="{{ route('product.product_detail', '') }}/${product.id}"
                                        style="color:black; text-decoration:none;">
                                        <img src="{{ asset('storage/images/product') }}/${product.image}" 
                                                class="card-img-top p-2" 
                                                alt="category image" 
                                                style="max-height:350px; min-height:350px;">
                                        <div class="card-body pt-2 border-top">
                                            <!-- Title with ellipsis after three lines -->
                                            <h4 class="card-title mt-3"
                                                style="overflow: hidden;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;">
                                                ${product.title}
                                            </h4>
                                            <!-- Short description with ellipsis after three lines -->
                                            <p class="card-text"
                                                style="overflow: hidden;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        -webkit-box-orient: vertical;">
                                                ${product.short_desc}
                                            </p>
                                            <!-- Product price -->
                                            <h3 class="card-text">${product.price}₹</h3>
                                        </div>
                                        </a>
                                    </div>
                                </div>

                    `;
                            });
                        } else {
                            productHtml =
                                '<center><h4 class="mt-2">No products found.</h4></center>';
                        }

                        $('#productList').html(productHtml);
                    },
                    error: function() {
                        $('#productList').html('<p>Error fetching products.</p>');
                    }

                });
            });
        });
    </script>
@endsection
