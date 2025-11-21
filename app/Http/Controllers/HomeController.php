<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function top_selling_products()
    {
        // Check if there are any orders
        $orderCount = \App\Models\Order::count();
        
        if ($orderCount == 0) {
            // If no orders, return latest products instead
            $products = Product::where('status', 1)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->latest()
                ->take(8)
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product->price,
                        'image' => $product->image,
                        'short_desc' => $product->short_desc,
                        'total_sold' => 0
                    ];
                });
            
            return response()->json(['products' => $products->values()]);
        }

        // Get top selling products
        $topProducts = \App\Models\Order::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->whereHas('product', function ($query) {
                $query->where('status', 1);
            })
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->take(8)
            ->with(['product' => function ($query) {
                $query->select('id', 'title', 'price', 'image', 'short_desc');
            }])
            ->get()
            ->map(function ($order) {
                return $order->product ? [
                    'id' => $order->product->id,
                    'title' => $order->product->title,
                    'price' => $order->product->price,
                    'image' => $order->product->image,
                    'short_desc' => $order->product->short_desc,
                    'total_sold' => $order->total_quantity
                ] : null;
            })
            ->filter();

        // If no top selling products found, return latest products
        if ($topProducts->isEmpty()) {
            $products = Product::where('status', 1)
                ->whereHas('category', function ($query) {
                    $query->where('status', 1);
                })
                ->latest()
                ->take(8)
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product->price,
                        'image' => $product->image,
                        'short_desc' => $product->short_desc,
                        'total_sold' => 0
                    ];
                });
            
            return response()->json(['products' => $products->values()]);
        }

        return response()->json(['products' => $topProducts->values()]);
    }



    // testing 
    public function welcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
