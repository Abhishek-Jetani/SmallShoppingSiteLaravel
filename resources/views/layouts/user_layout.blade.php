<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>

    {{-- bootstrap 5  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">

    @yield('styles')


    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .home_image_div {
            max-width: 95px;
            max-height: 95px;
            margin-left: 25px;
        }

        .home_image {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        .btn_profile {
            color: white;
            background: orangered;
            border: 1px solid orangered;
            border-radius: 5px;
        }

        .btn_profile:hover {
            color: white;
            background: rgb(228, 68, 10);
        }

        .home_cart {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .home_cart:hover {
            background: #ef2a10;
            color: white;
            /* border: none !important; */
        }

        .home_ul>li>a {
            color: #000000;
            font-weight: 500;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .cart_count {
            background: orangered;
            color: white;
            border: 1px solid orangered;
            border-radius: 55px;
        }

        .my_wishlist {
            color: #000;
            text-decoration: none;
        }


        .home_li>.active_nav {
            color: #0080ff;
            border-radius: 10px;
        }



        /* footer start  */
        .subscribe_email {
            width: 100%;
            background: #000;
            display: block;
        }

        .subscribe_email h4 {
            color: white;
            margin-left: 35px;
            padding: 30px;
        }

        .subscribe_email form {
            color: white;
            margin-right: 35px;
            padding: 30px;
        }

        .subscribe_email input {
            width: 425px;
        }

        .subscribe_email form button {
            background: orangered;
            color: white;
        }

        .subscribe_email form button:hover {
            background: rgb(225, 63, 5);
            color: white;
        }

        .footer {
            background: rgb(0, 0, 0);
            color: white;
        }

        .dropdown-menu {
            margin-left: -66px !important;
        }

        /* custom loader  */
        .lds-dual-ring,
        .lds-dual-ring:after {
            box-sizing: border-box;
        }

        .lds-dual-ring {
            /* z-index: 1; */
            margin-top: 300px;
            height: 80px;
            display: flex;
            justify-content: center !important;
            align-items: center !important;

        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            border-radius: 90%;
            border: 6.4px solid currentColor;
            border-color: currentColor transparent currentColor transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .log_in_btn {
            width: 100px !important;
        }
    </style>
</head>

<body>

    <div class="lds-dual-ring"></div>

    {{-- ---------------------- header start ---------------------- --}}

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <div class="col-auto">
                    <img src="{{ asset('images/bg_1.jpg') }}" alt="Brand Logo" class="rounded"
                        style="width: 55px; height: auto; object-fit: cover;">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="home_ul navbar-nav me-auto mb-2 ms-5 mb-lg-0">
                    @php
                        $currentRoute = Route::currentRouteName();
                    @endphp
                    <li class="nav-item home_li">
                        <a class="nav-link home_li_a {{ $currentRoute == 'home' ? 'active_nav' : '' }}"
                            aria-current="page" href="{{ route('home') }}">
                            Home</a>
                    </li>
                    <li class="nav-item home_li">
                        <a class="nav-link home_li_a {{ $currentRoute == 'products.index' ? 'active_nav' : '' }}"
                            href=" {{ route('products.index') }}">
                            Products</a>
                    </li>
                    <li class="nav-item home_li">
                        <a class="nav-link home_li_a {{ $currentRoute == 'order.getUserOrders' ? 'active_nav' : '' }}"
                            href=" {{ route('order.getUserOrders') }}">
                            My Order</a>
                    </li>
                    <li class="nav-item home_li">
                        <a class="nav-link home_li_a {{ $currentRoute == 'user.aboutus' ? 'active_nav' : '' }}"
                            href=" {{ route('user.aboutus') }}">
                            About us</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item home_li">
                            <a class="nav-link home_li_a {{ $currentRoute == 'wishlist.index' ? 'active_nav' : '' }}"
                                href=" {{ route('wishlist.index') }}">
                                <i class="fa fa-heart-o"> </i> Wishlist</a>
                        </li>
                    @endif
                </ul>
                <div class="d-flex">

                    <a href="{{ route('cart.index') }}" class="home_cart btn border-dark me-2" type="submit"><i
                            class="fa fa-shopping-cart me-1"> </i> My cart <sup id="cart-count"></sup></a>
                    <div>
                        <ul class="navbar-nav h-35 m-0 p-0">
                            <li class="nav-item dropdown m-0 p-0">
                                @if (Auth::check())
                                    <a class="nav-link dropdown-toggle ms-1 username" href="" id="drop2"
                                        style="paddind:0;" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="../assets/images/profile/user-1.jpg" alt="" width="30"
                                            height="30" class="rounded-circle ">
                                        <span class="text single-line"> {{ Auth::user()->name }} </span>
                                    </a>
                                @else
                                    <a class="nav-link btn m-0 ms-1 btn log_in_btn"
                                        style="color: white;background:orangered;" href="{{ route('login') }}">Sign
                                        up</a>
                                @endif


                                <ul class="dropdown-menu dropdown-menu-light"
                                    aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('changePassword') }}">
                                            <i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                                    </li>
                                    <li><a class="dropdown-item" href="/password/reset">
                                            <i class="fa fa-lock" aria-hidden="true"></i> Forgot Password</a>
                                    </li>
                                    {{-- authenticate check  --}}
                                    @if (Auth::check())
                                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- ---------------------- header end ---------------------- --}}



    {{-- ---------------------- body content start ---------------------- --}}
    <div class="border-top mt-1">
        @yield('content')
    </div>
    {{-- ---------------------- body content end ---------------------- --}}



    {{-- ---------------------- footer start ---------------------- --}}
    <div class="footer">
        <div class="subscribe_email d-flex">
            <h4 class="flex-grow-1">Get Exclusive insights: Subscribe now to our newsletter!</h4>
            <form class="d-flex">
                <input class=" me-2" type="search" placeholder="   Type your mail" aria-label="Search"
                    style="border-radius: 5px; border:1px solid white;">
                <button class="btn" type="submit">Subscribe</button>
            </form>
        </div>

        <div class="m-0 p-0 text-light">
            <footer class="footer row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5  border-top m-0 p-0">
                <div class="col mb-3 ps-5">
                    <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                        <img src="https://t3.ftcdn.net/jpg/03/65/42/00/360_F_365420014_xjsSDkKzrhq4gr9GFzP6S97H7MJyNI5B.jpg"
                            width="40" height="32"></img>
                    </a>
                    <p class="text-light ">© 2024</p>
                </div>

                <div class="col mb-3">

                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">

                        <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-light">Home</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('user.aboutus') }}"
                                class="nav-link p-0 text-light">About Us</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.privacy_policy') }}"
                                class="nav-link p-0 text-light">Privacy & Policy</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.term_condition') }}"
                                class="nav-link p-0 text-light">Terms And Conditions</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('products.index') }}"
                                class="nav-link p-0 text-light">Products</a></li>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-light">Home</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('user.aboutus') }}"
                                class="nav-link p-0 text-light">About Us</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.privacy_policy') }}"
                                class="nav-link p-0 text-light">Privacy & Policy</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.term_condition') }}"
                                class="nav-link p-0 text-light">Terms And Conditions</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('products.index') }}"
                                class="nav-link p-0 text-light">Products</a></li>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-light">Home</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('user.aboutus') }}"
                                class="nav-link p-0 text-light">About Us</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.privacy_policy') }}"
                                class="nav-link p-0 text-light">Privacy & Policy</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('user.term_condition') }}"
                                class="nav-link p-0 text-light">Terms And Conditions</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('products.index') }}"
                                class="nav-link p-0 text-light">Products</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    {{-- ---------------------- footer end ---------------------- --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateCartCount() {
            $.ajax({
                url: '/cart/count',
                method: 'GET',
                success: function(data) {
                    $('#cart-count').text(data.count);
                },
                error: function(err) {
                    console.error('Error fetching cart count:', err);
                }
            });
        }
        updateCartCount();

        // custom loding
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    ".lds-dual-ring").style.visibility = "visible";
            } else {
                document.querySelector(
                    ".lds-dual-ring").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>


    @if (session()->has('success'))
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
    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 3000,
            })
        </script>
    @endif

    @yield('scripts')
</body>

</html>
