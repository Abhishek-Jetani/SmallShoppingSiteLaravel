@extends('layouts.admin_layout')
@section('title')
    Category Details
@endsection
@section('styles')
    <style>
        .container {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">
        <h2 class="float-start">Category details</h2>
        <a href="{{ route('category.index') }}" class="float-end btn btn-primary">Back to category </a>
        </a>
    </div><br><br>


    <section class="main ">
        <div class="container pt-2 pb-2" style="background: white;">
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Title:</strong> {{ $category->title }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $category->description }}</p>
                    <p class="card-text"><strong>Image:</strong> <img
                            src="{{ asset('storage/images/category/' . $category->image) }}" width="50px" height="50px"
                            class="rounded" alt="abcd" title="" /></p>
                    <p class="card-text"><strong>Status:</strong>
                        @if ($category->status == 0)
                            <span class="badge text-bg-danger">Deactivate</span>
                        @else
                            <span class="badge text-bg-success">Activate </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
