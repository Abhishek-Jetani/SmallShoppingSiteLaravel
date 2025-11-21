{{-- products/index.blade.php  --}}
@extends('layouts.user_layout')

@section('title')
    Products
@endsection

@section('styles')
<style>

/* ===== PAGE BG ===== */
.page-wrapper {
    background: #f5f5f7;
    padding: 20px 0;
}

/* ===== FILTER CARD ===== */
.filter-box {
    background: #ffffff;
    border-radius: 10px;
    padding: 18px 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,.1);
}

/* ===== ANIMATED DROPDOWN ARROW ===== */
.dropdown-wrapper {
    position: relative;
}
.dropdown-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    font-size: 14px;
    transform: translateY(-50%);
    pointer-events: none;
    transition: .2s;
}
.dropdown-arrow::before {
    content: '\25BC';
}
.open .dropdown-arrow::before {
    content: '\25B2';
}

/* ===== PRODUCT CARD ===== */
.product-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    border: none;
    transition: .3s;
    animation: fadeIn .5s forwards;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,.20);
}
.product-card img {
    height: 280px;
    width: 100%;
    object-fit: cover;
    transition: .4s;
}
.product-card:hover img {
    transform: scale(1.05);
}

/* ===== CARD TEXT ===== */
.product-card-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-weight: 700;
    font-size: 18px;
}
.product-card-desc {
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    overflow: hidden;
}
.product-price {
    font-size: 26px;
    font-weight: 700;
}

/* ===== NO RESULT ===== */
.no-result {
    animation: fadeIn .5s forwards;
}

/* ===== ANIMATION KEYFRAMES ===== */
@keyframes fadeIn {
    from { opacity:0; transform: translateY(12px); }
    to   { opacity:1; transform: translateY(0); }
}
</style>
@endsection


@section('content')
<div class="page-wrapper">

    <div class="container mb-4">

        <!-- FILTER SECTION -->
        <div class="row mb-4">
            <div class="col-12 filter-box">

                <div class="row">
                    <div class="col-sm-10">
                        <label class="fw-bold">Select Category</label>
                        <div class="dropdown-wrapper">
                            <select class="form-control" id="categoryDropdown">
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

                    <div class="col-sm-2">
                        <label class="fw-bold">Sort Price</label>
                        <div class="dropdown-wrapper">
                            <select class="form-control" id="sortDropdown">
                                <option value="">Default</option>
                                <option value="asc">Low to High</option>
                                <option value="desc">High to Low</option>
                            </select>
                            <span class="dropdown-arrow"></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- PRODUCT LIST -->
        <div class="row" id="productList">

            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('product.product_detail', $product->id) }}" style="color:inherit;text-decoration:none;">
                        <div class="product-card">

                            <img src="{{ asset('storage/images/product/'.$product->image) }}" onerror="this.onerror=null;this.src='{{ asset('images/no_image.png') }}';">

                            <div class="p-3">
                                <h5 class="product-card-title">
                                    {{ $product->title }}
                                </h5>

                                <p class="product-card-desc text-muted">
                                    {{ $product->short_desc }}
                                </p>

                                <p class="product-price">
                                    ₹{{ $product->price }}
                                </p>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>

    </div>

</div>
@endsection


@section('scripts')
<script>
/* toggle arrow animation */
document.querySelectorAll('.dropdown-wrapper').forEach(wrapper => {
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

        let categoryId = $('#categoryDropdown').val();
        let sortBy     = $('#sortDropdown').val();

        let data = {
            _token: '{{ csrf_token() }}',
            sort_by: sortBy
        };
        if (categoryId) data.category_id = categoryId;

        $.ajax({
            url: categoryId ? '{{ route('products.byCategory') }}'
                            : '{{ route('products.all') }}',
            type: 'POST',
            data: data,
            success: function(products) {

                let html = "";

                if (products.length > 0) {

                    products.forEach(product => {

                        html += `
                            <div class="col-md-3 mb-4">
                                <a href="{{ route('product.product_detail', '') }}/${product.id}"
                                    style="color:inherit;text-decoration:none;">

                                    <div class="product-card">

                                        <img src="${product.image 
                                            ? `{{ asset('storage/images/product') }}/${product.image}` 
                                            : `{{ asset('images/no_image.png') }}`}" />

                                        <div class="p-3">
                                            <h5 class="product-card-title">${product.title}</h5>
                                            <p class="product-card-desc text-muted">${product.short_desc}</p>
                                            <p class="product-price">₹${product.price}</p>
                                        </div>

                                    </div>
                                </a>
                            </div>`;
                    });

                } else {

                    html = `
                    <div class="col-12 text-center no-result">
                        <h4 class="text-muted mt-2">No products found.</h4>
                    </div>
                    `;
                }

                $('#productList').html(html);

            },
            error: function() {
                $('#productList').html(
                    '<div class="col-12 text-center no-result"><h4>Error loading products.</h4></div>'
                );
            }
        });

    });

});
</script>
@endsection
