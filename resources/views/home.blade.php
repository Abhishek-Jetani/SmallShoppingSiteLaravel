@extends('layouts.user_layout')
@section('title')
    User Home
@endsection

@section('styles')
<style>

/* HERO */
.hero-main {
    background: linear-gradient(135deg, #9b59b6, #6d2fa1);
    padding: 130px 40px;
    border-radius: 12px;
    color: #fff;
}

/* PRODUCT CARD */
.product-card {
    border-radius: 12px;
    overflow: hidden;
    transition: .4s;
    background: #fff;
}
.product-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 10px 35px rgba(0,0,0,.25);
}
.product-card img {
    height: 260px;
    width: 100%;
    object-fit: cover;
}

/* FEATURE BLOCKS */
.icon-box {
    padding: 35px 20px;
    border-radius: 10px;
    background: #f8f9fa;
    text-align: center;
    transition: .3s;
}
.icon-box:hover {
    background: #efefef;
}

/* SECTION TITLES */
.sec-title {
    font-weight: 700;
    font-size: 38px;
}

/* COUNTERS */
.counter-box {
    background: #fff;
    padding: 35px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px #ddd;
}
.counter-number {
    font-size: 45px;
    font-weight: 800;
}

/* NEWS CARDS */
.news-card {
    border-radius: 10px;
    background: #f3f3f3;
    padding: 20px;
    transition:.3s;
}
.news-card:hover {
    background:#e9e9e9;
}

/* TESTIMONIALS */
.testimonial-card {
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 12px rgba(0,0,0,.15);
}

/* NEWSLETTER */
.newsletter-box {
    background:#9b59b6;
    padding:50px;
    border-radius:12px;
    text-align:center;
    color:#fff;
}

/* FOOTER */
.footer-area {
    background:#111;
    color:#ccc;
    padding:35px;
}

</style>
@endsection


@section('content')


<!-- ================= HERO SECTION ================ -->
<div class="container-fluid mt-3 mb-5" data-aos="fade-up">
    <div class="hero-main">
        <h1 class="display-4 fw-bold">Welcome to Our Store</h1>
        <p class="fs-5 mt-3 mb-4">
            Discover premium products at the best prices.
        </p>
        <a href="{{ route('product.index') }}" class="btn btn-light btn-lg px-4 shadow-sm">
            Shop Now
        </a>
    </div>
</div>


<!-- ================ FEATURE HIGHLIGHTS ================ -->
<div class="container my-5">
    <div class="row g-4">

        <div class="col-md-4" data-aos="zoom-in">
            <div class="icon-box">
                <h4 class="fw-bold mb-2">Free Delivery</h4>
                <p>Fast shipping, no extra cost.</p>
            </div>
        </div>

        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
                <h4 class="fw-bold mb-2">Secure Payments</h4>
                <p>100% protected checkout.</p>
            </div>
        </div>

        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
                <h4 class="fw-bold mb-2">24/7 Support</h4>
                <p>Help anytime you need it.</p>
            </div>
        </div>

    </div>
</div>


<!-- ================== LIVE COUNTERS ================== -->
<div class="container mb-5">
    <div class="row g-4">

        <div class="col-md-3" data-aos="fade-up">
            <div class="counter-box">
                <div class="counter-number" data-count="1500">0</div>
                <p>Products Sold</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="counter-box">
                <div class="counter-number" data-count="350">0</div>
                <p>Brands Available</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="counter-box">
                <div class="counter-number" data-count="9200">0</div>
                <p>Happy Customers</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="600">
            <div class="counter-box">
                <div class="counter-number" data-count="75">0</div>
                <p>Cities Served</p>
            </div>
        </div>

    </div>
</div>



<!-- ================== LATEST PRODUCTS ================== -->
<div class="py-5" style="background:#000;">
    <div class="container">
        <h2 class="text-light sec-title mb-4" data-aos="fade-up">Latest Products</h2>
        <div class="row" id="latest_product">
            <!-- AJAX product cards -->
        </div>
    </div>
</div>


<!-- ================== NEWS SECTION ================== -->
<div class="container my-5">
    <h2 class="sec-title mb-4" data-aos="fade-up">Store News & Updates</h2>
    <div class="row g-4">

        <div class="col-md-4" data-aos="flip-left">
            <div class="news-card">
                <h5 class="fw-bold">Festive Mega Sale</h5>
                <p>Huge discounts launching soon.</p>
                <small class="text-muted">1 day ago</small>
            </div>
        </div>

        <div class="col-md-4" data-aos="flip-left" data-aos-delay="200">
            <div class="news-card">
                <h5 class="fw-bold">Logistics Expansion</h5>
                <p>Now delivering to 70+ cities.</p>
                <small class="text-muted">This week</small>
            </div>
        </div>

        <div class="col-md-4" data-aos="flip-left" data-aos-delay="400">
            <div class="news-card">
                <h5 class="fw-bold">New Brands Added</h5>
                <p>More premium brands now available.</p>
                <small class="text-muted">Just Now</small>
            </div>
        </div>

    </div>
</div>


<!-- ===================== FAQ ===================== -->
<div class="container my-5">
    <h2 class="sec-title mb-4" data-aos="fade-up">FAQ</h2>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item" data-aos="fade-up">
            <h2 class="accordion-header">
                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#ans1">
                    What is the delivery time?
                </button>
            </h2>
            <div id="ans1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    2–7 business days depending on your location.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ans2">
                    Do you support returns?
                </button>
            </h2>
            <div id="ans2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Yes, most products have 7-day return policy.
                </div>
            </div>
        </div>

        <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ans3">
                    Which payments are accepted?
                </button>
            </h2>
            <div id="ans3" class="accordion-collapse collapse">
                <div class="accordion-body">
                    We support UPI, Cards, Wallets & Net Banking.
                </div>
            </div>
        </div>

    </div>
</div>


<!-- ================= TESTIMONIALS ================= -->
<div class="container my-5">
    <h2 class="sec-title mb-4" data-aos="fade-up">What Our Customers Say</h2>

    <div class="row g-4">

        <div class="col-md-4" data-aos="zoom-in">
            <div class="testimonial-card">
                ⭐⭐⭐⭐⭐
                <p class="mt-2">Amazing quality and timely delivery!</p>
                <b>— Neha</b>
            </div>
        </div>

        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="testimonial-card">
                ⭐⭐⭐⭐⭐
                <p class="mt-2">Customer support helped instantly.</p>
                <b>— Amit</b>
            </div>
        </div>

        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="testimonial-card">
                ⭐⭐⭐⭐⭐
                <p class="mt-2">Best price compared to other stores!</p>
                <b>— Sana</b>
            </div>
        </div>

    </div>
</div>


<!-- ================= NEWSLETTER ================= -->
<div class="container my-5">
    <div class="newsletter-box" data-aos="fade-up">
        <h2 class="fw-bold mb-3">Subscribe for Offers</h2>
        <p>Get update alerts, exclusive deals & early access.</p>

        <form class="mt-3 row justify-content-center">
            <div class="col-md-6">
                <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
            </div>
            <div class="col-md-3 mt-3 mt-md-0">
                <button class="btn btn-light btn-lg w-100">Subscribe</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= FOOTER ================= -->
<div class="footer-area text-center mt-5">
    <p>© {{ date('Y') }} YourStore - All Rights Reserved</p>
</div>

@endsection


@section('scripts')

@if (session('errorr'))
    <div class="alert alert-danger">
        {{ session('errorr') }}
    </div>
@endif


<script>
// LIVE COUNTER ANIMATION
const counters = document.querySelectorAll('.counter-number');
counters.forEach(counter => {
    let target = +counter.getAttribute('data-count');
    let current = 0;
    let speed = target / 100;

    setInterval(() => {
        if (current < target) {
            current += speed;
            counter.innerText = Math.ceil(current);
        }
    }, 20);
});

// AJAX LOAD PRODUCTS
$(document).ready(function () {
    $.ajax({
        url: "{{ route('user.latest_product_home') }}",
        type: "GET",
        success: function(response) {

            if (response.products) {

                let html = "";

                response.products.forEach(product => {
                    html += `
                    <div class="col-md-4 mb-4" data-aos="zoom-in">
                        <a href="{{ route('product.product_detail', '') }}/${product.id}"
                           style="text-decoration:none; color:inherit;">

                            <div class="card product-card">
                                <img src="{{ asset('storage/images/product') }}/${product.image}" alt="">

                                <div class="card-body">
                                    <h5 class="fw-bold mb-2">${product.title}</h5>
                                    <p class="text-muted">${product.short_desc}</p>
                                    <h4 class="fw-bold">₹${product.price}</h4>
                                </div>
                            </div>
                        </a>
                    </div>`;
                });

                $('#latest_product').html(html);
            }

        }
    });
});
</script>
@endsection
