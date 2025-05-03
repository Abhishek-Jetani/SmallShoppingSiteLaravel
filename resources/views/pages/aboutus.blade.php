@extends('layouts.user_layout')
@section('content')

    <div>
        <div>
            <div class="bg-image p-5 text-center shadow-1-strong  mb-5 text-white"
                style="background-image: linear-gradient(to bottom right, rgb(201, 195, 195), rgb(22, 21, 21));">
                <h1 class="mb-3 h2">About Us</h1>
            </div>
        </div>
        <div class="container">

            <div class="row  align-items-center">
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

            <div class="row  align-items-center mt-4">
                <div class="col-md-6 p-5">
                    <label class="text-info">About Us</label>
                    <h1>Small Shopping Site <label class="text-info"> Here! </label> </h1>
                    <p style="font-size: 20px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit repellat
                        iure laboriosam cum voluptatum, nam minima deserunt aut? Distinctio voluptatibus dolor quaerat quo
                        omnis illo sequi at velit, odit quod!</p>
                    <button class="btn btn-primary btn-lg" style="font">Our Vision</button>
                </div>
                <div class="col-md-6 p-0">
                    <img src="{{ asset('images/aboutushome.jpg') }}"style="object-fit: fill; border:1px solid rgb(0, 0, 0); width:100%; max-height:500px; min-height:400px; border-radius:15px;"
                        alt="about photo">
                </div>
            </div>

        </div>
    </div>
@endsection
