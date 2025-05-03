<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware([]);
    }

    public function index()
    {
        return view('home');
    }

    public function latest_product_home()
    {
        $products = Product::where('status', 1)->whereHas('category', function ($query) {
            $query->where('status', 1);
        })->latest()->take(4)->get();

        return response()->json(['products' => $products]);
    }



    // testing 
    public function welcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
