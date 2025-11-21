@extends('layouts.user_layout')

@section('content')

<style>
    .about-header {
        background-image: linear-gradient(to bottom right, #cfcfcf, #1a1a1a);
        padding: 60px 20px;
        text-align: center;
        color: white;
        border-radius: 0 0 10px 10px;
    }

    .about-section {
        margin-bottom: 60px;
    }

    .about-title {
        font-size: 36px;
        font-weight: 700;
    }

    .about-text {
        font-size: 18px;
        line-height: 1.7;
        color: #555;
    }

    .about-img {
        width: 100%;
        max-height: 500px;
        border-radius: 15px;
        object-fit: cover;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
    }

    .about-btn {
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.2);
    }

    .about-label {
        color: #0077ff;
        font-weight: 600;
        letter-spacing: 1px;
        font-size: 15px;
    }

    .about-block h1 {
        font-size: 32px;
        font-weight: 700;
    }
</style>



<div>

    {{-- Header --}}
    <div class="about-header shadow-lg mb-4">
        <h1 class="mb-0">About Us</h1>
    </div>


    <div class="container">

        {{-- Section 1 --}}
        <div class="row about-section align-items-center">
            <div class="col-md-6 p-0">
                <img src="{{ asset('images/aboutus2.jpg') }}" class="about-img" alt="about photo">
            </div>

            <div class="col-md-6 p-5 about-block">
                <span class="about-label">ABOUT US</span>
                <h1>
                    Small Shopping Site <span style="color:#0077ff;">Here!</span>
                </h1>

                <p class="about-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Suscipit nostrum ullam totam ut laborum porro dignissimos omnis!
                    Molestias accusamus nesciunt voluptate dignissimos consequuntur
                    iure repellat amet impedit!
                </p>

                <button class="btn btn-primary about-btn">
                    Our Mission
                </button>
            </div>
        </div>


        {{-- Section 2 --}}
        <div class="row about-section align-items-center flex-md-row-reverse">
            <div class="col-md-6 p-0">
                <img src="{{ asset('images/aboutushome.jpg') }}" class="about-img" alt="about photo">
            </div>

            <div class="col-md-6 p-5 about-block">
                <span class="about-label">ABOUT US</span>
                <h1>
                    Small Shopping Site <span style="color:#0077ff;">Here!</span>
                </h1>

                <p class="about-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Suscipit nostrum ullam totam ut laborum porro dignissimos omnis!
                    Molestias accusamus nesciunt voluptate dignissimos consequuntur
                    iure repellat amet impedit!
                </p>

                <button class="btn btn-primary about-btn">
                    Our Vision
                </button>
            </div>
        </div>

    </div>
</div>

@endsection
