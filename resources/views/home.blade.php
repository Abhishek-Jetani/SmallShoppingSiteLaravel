@extends('layouts.user_layout')
@section('title')
    User Home
@endsection

@section('styles')
<style>

/* HERO */
.hero-main {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 130px 40px;
    border-radius: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.hero-main::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.hero-main h1 {
    position: relative;
    z-index: 2;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    animation: fadeInDown 1s ease;
}

.hero-main p {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease 0.2s both;
}

.hero-main .btn {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease 0.4s both;
    padding: 12px 40px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 50px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.hero-main .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
    border-radius: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    text-align: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.icon-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: left 0.4s ease;
    z-index: 0;
}

.icon-box:hover::before {
    left: 0;
}

.icon-box h4,
.icon-box p {
    position: relative;
    z-index: 1;
    transition: color 0.4s;
}

.icon-box:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    border-color: #667eea;
}

.icon-box:hover h4,
.icon-box:hover p {
    color: white;
}

.icon-box h4::before {
    content: '✓ ';
    color: #667eea;
    transition: color 0.4s;
}

.icon-box:hover h4::before {
    color: white;
}

/* SECTION TITLES */
.sec-title {
    font-weight: 700;
    font-size: 38px;
}

/* COUNTERS */
.counter-box {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 35px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    border: 2px solid transparent;
}

.counter-box::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.counter-box:hover::after {
    transform: scaleX(1);
}

.counter-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
    border-color: #667eea;
}

.counter-number {
    font-size: 45px;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.4s;
}

.counter-box:hover .counter-number {
    transform: scale(1.1);
}

/* NEWS CARDS */
.news-card {
    border-radius: 15px;
    background: linear-gradient(135deg, #f3f3f3 0%, #e9ecef 100%);
    padding: 25px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.news-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleY(0);
    transition: transform 0.4s ease;
}

.news-card:hover::before {
    transform: scaleY(1);
}

.news-card:hover {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    transform: translateX(10px) translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    border-color: #667eea;
}

.news-card h5 {
    position: relative;
    padding-left: 20px;
}

.news-card h5::before {
    content: '📢';
    position: absolute;
    left: 0;
    font-size: 18px;
}

/* TOP SELLING PRODUCTS */
.top-selling-card {
    border-radius: 15px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    height: 100%;
}

.top-selling-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.top-selling-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff6b6b, #ee5a6f, #ff4757);
    opacity: 0;
    transition: opacity 0.3s;
}

.top-selling-card:hover::before {
    opacity: 1;
}

.top-selling-card img {
    height: 220px;
    width: 100%;
    object-fit: cover;
    transition: transform 0.4s;
}

.top-selling-card:hover img {
    transform: scale(1.1);
}

.top-selling-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 3px 10px rgba(255, 107, 107, 0.4);
}

.top-selling-stats {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 15px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    display: inline-block;
    margin-top: 10px;
}

/* TESTIMONIALS */
.testimonial-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    border: 2px solid transparent;
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 80px;
    color: #667eea;
    opacity: 0.2;
    font-family: serif;
    line-height: 1;
}

.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
    border-color: #667eea;
}

.testimonial-card p {
    position: relative;
    z-index: 1;
    font-style: italic;
    line-height: 1.8;
}

.testimonial-card b {
    color: #667eea;
    font-weight: 600;
}

/* NEWSLETTER */
.newsletter-box {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px;
    border-radius: 20px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.newsletter-box::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 25s linear infinite;
}

.newsletter-box * {
    position: relative;
    z-index: 2;
}

.newsletter-box .form-control {
    border-radius: 50px;
    padding: 15px 25px;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.newsletter-box .btn {
    border-radius: 50px;
    padding: 15px 40px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.newsletter-box .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
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


<!-- ================== TOP SELLING PRODUCTS ================== -->
<div class="container my-5 py-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <h2 class="sec-title mb-3">
            <i class="fas fa-fire text-danger"></i> Top Selling Products
        </h2>
        <p class="text-muted">Our most loved products by customers</p>
    </div>
    <div class="row g-4" id="top_selling_products">
        <!-- AJAX top selling product cards -->
        <div class="col-12 text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
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

                response.products.forEach((product, index) => {
                    html += `
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="${index * 100}">
                        <a href="{{ route('product.product_detail', '') }}/${product.id}"
                           style="text-decoration:none; color:inherit;">

                            <div class="card product-card">
                                <img src="{{ asset('storage/images/product') }}/${product.image}" alt="" onerror="this.src='{{ asset('images/no_image.png') }}'">

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

    // AJAX LOAD TOP SELLING PRODUCTS
    $.ajax({
        url: "{{ route('user.top_selling_products') }}",
        type: "GET",
        success: function(response) {
            let html = "";

            if (response.products && response.products.length > 0) {
                response.products.forEach((item, index) => {
                    const rank = index + 1;
                    const rankBadge = rank <= 3 ? `<span class="top-selling-badge"><i class="fas fa-trophy"></i> #${rank}</span>` : '';
                    
                    html += `
                    <div class="col-md-3 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="${index * 100}">
                        <a href="{{ route('product.product_detail', '') }}/${item.id}"
                           style="text-decoration:none; color:inherit;">
                            <div class="top-selling-card">
                                ${rankBadge}
                                <img src="{{ asset('storage/images/product') }}/${item.image}" alt="${item.title}">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-2">${item.title}</h6>
                                    <p class="text-muted small mb-2">${item.short_desc}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold text-primary mb-0">₹${item.price}</h5>
                                        <span class="top-selling-stats">
                                            <i class="fas fa-shopping-cart"></i> ${item.total_sold} sold
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>`;
                });
            } else {
                html = `<div class="col-12 text-center">
                    <p class="text-muted">No top selling products available yet.</p>
                </div>`;
            }

            $('#top_selling_products').html(html);
        },
        error: function() {
            $('#top_selling_products').html(`<div class="col-12 text-center">
                <p class="text-muted">Unable to load top selling products.</p>
            </div>`);
        }
    });
});
</script>
@endsection
