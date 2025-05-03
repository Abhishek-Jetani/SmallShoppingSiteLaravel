@extends('layouts.user_layout')
@section('title')
    User Home 
@endsection
@section('styles')
    <style>
        .home_image1_div {
            max-width: 50%;
            max-height: 50%;
            height: 400px;
            margin: 0;
            padding: 0;
        }

        .home_image1_div img {
            object-fit: cover;
            height: auto;
            width: 100%;
            margin: 0;
            padding: 0;
            border-radius: 0px;
        }

        .home_content_div {
            max-width: 50%;
            max-height: 50%;
            height: 400px;
            margin: 0;
            padding: 0;
            background: rgb(134, 51, 134);
        }

        .home_content_div .home_content {
            object-fit: cover;
            height: auto;
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
@endsection
@section('content')
    <div class="row p-2" style="margin: 0; padding:0;">
        <div class="col-sm-6 home_content_div">
            <div class="home_content ms-3 text-light">
                <h1 class="mt-5">BIG <label style="font-size: 65px">BRANDS</label> </h1>
                <h2>MORE <label style="font-size: 65px">SAVING</label> </h2>
                <p>Flat 30% of on exclusive products</p>
                <p>Use code <mark> FLAT30 </mark> </p>
            </div>
        </div>
        <div class="col-sm-6 home_image1_div">
            <img src="images/bg_1.jpg" class="home_image" alt="home image" height="50%">
        </div>
    </div>


    <!-- latest 3 products -->
    <div style="background:#000000;">
        <div class="p-4">
            <h2 class="text-light mt-3 mb-4"><b> Latest Products </b></h2>
            <div class="row" id="latest_product">
                <!-- AJAX-data show here -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center mt-5 mb-5">
            <div class="col-md-6 p-0">
                <img src="{{ asset('images/aboutus2.jpg') }}"
                    style="object-fit: fill; border:1px solid rgb(0, 0, 0); width:100%; max-height:500px; border-radius:15px;"
                    alt="about photo">
            </div>
            <div class="col-md-6 p-5">
                <label class="text-info">About Us</label>
                <h1>Small Shopping Site <label class="text-info"> Here! </label> </h1>
                <p style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellat
                    iure laboriosam cum voluptatum, nam minima deserunt aut? Distinctio voluptatibus dolor quaerat quo
                    omnis illo sequi at velit, odit quod!</p>
                <button class="btn btn-primary btn-lg" style="font">Our Mission</button>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @if (session('errorr'))
        <div class="alert alert-danger">
            {{ session('errorr') }}
        </div>
    @endif
   

    <script>
        $(document).ready(function() {

            // latest 3 product 
            $.ajax({
                url: "{{ route('user.latest_product_home') }}",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.products && Array.isArray(response.products)) {
                        var productHtml = '';

                        response.products.forEach(function(product) {
                            productHtml += `
                        <div class="col-sm-3">
                            <a href="{{ route('product.product_detail', '') }}/${product.id}"
                            style="color:black; text-decoration:none;">
                            <div class="card" style="max-height:500px; min-height:500px;">
                                <img src="{{ asset('storage/images/product') }}/${product.image}" 
                                        class="card-img-top" 
                                        alt="category image" 
                                        style="max-height:300px; min-height:300px;">
                                <div class="card-body  border-top">
                                   
                                    <h4 class="card-title mt-3"
                                        style="overflow: hidden;
                                                display: -webkit-box;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;">
                                        ${product.title}
                                    </h4>
                                   
                                    <p class="card-text"
                                        style="overflow: hidden;
                                                display: -webkit-box;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;">
                                        ${product.short_desc}
                                    </p>
                                 
                                    <h3 class="card-text"><sup style="color:#31363F;">₹</sup>${product.price}</h3>
                                </div>
                                </div>
                                </a>
                        </div>
                        `;
                        });

                        $('#latest_product').html(productHtml);
                    } else {
                        console.error('Unexpected response structure');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching latest products:', error);
                }
            });


        });
    </script>
@endsection
