<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminProductRequest;
use App\Http\Resources\AdminProductResource;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return AdminProductResource::collection($products);
    }

    public function store(AdminProductRequest $request)
    {
        try {
            $request->validated();
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $imagePath = storeImageDatabase($request->file('image'), 'public/images/product', 'Product');
            $product = new Product($request->all());
            $product->image = $imagePath;
            $product->save();

            return new AdminProductResource($product);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function show(Product $product)
    {
        // if user has token so go next otherwise error 
        if (auth('api')->check()) {
            return new AdminProductResource($product);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // return new AdminProductResource($product);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return response()->json([
            'product' => new AdminProductResource($product),
            'categories' => $categories
        ]);
    }

    public function update(AdminProductRequest $request, Product $product)
    {
        try {
            $request->validated();

            if ($request->hasFile('image')) {
                if ($product->image) {
                    deleteImageInStorage('public/images/product', $product->image);
                }
                $imagePath = storeImageDatabase($request->file('image'), 'public/images/product', 'Product');
                $product->image = $imagePath;
            }

            $product->update($request->all());

            return response()->json(['product' => $product, 'message' => 'product updated'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $result = deleteItem(Product::class, $product->id, 'public/images/product');
            if ($result['success']) {
                return response()->json(['message' => 'Product deleted successfully']);
            } else {
                return response()->json(['error' => $result['message']], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}
