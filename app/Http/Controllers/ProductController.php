<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->whereHas('category', function ($query) {
            $query->where('status', 1);
        })->get();
        return view('product.index', compact('categories', 'products'));
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $sortBy = $request->input('sort_by', 'asc');

        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($sortBy === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'desc') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->where('status', 1)->get();

        return response()->json($products);
    }

    public function getAllProducts(Request $request)
    {
        $sortBy = $request->input('sort_by', 'asc');

        $query = Product::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            });
        if ($sortBy === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'desc') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->get();
        return response()->json($products);
    }

    public function product_detail(Product $product)
    {
        $userId = Auth::id();
        $cartItem = Cart::where(['product_id' => $product->id, 'user_id' => $userId])->exists();
        $wishlistItem = Wishlist::where(['user_id' => $userId, 'product_id' => $product->id])->first();
        $Products = Product::where('id', $product->id)->get();
        return view('product.product_details', compact('Products', 'cartItem', 'wishlistItem'));
    }

    public function addToWishlist(Request $request, $productId)
    {
        try {
            $product = Product::find($productId);

            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
            $wishlistItem = Wishlist::where('product_id', $productId)->where('user_id', Auth::id())->first();

            if ($wishlistItem) {
                return response()->json(['success' => true, 'message' => 'Product already in wishlist']);
            }
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
            return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
        } catch (\Throwable $th) {
        }
    }
}
