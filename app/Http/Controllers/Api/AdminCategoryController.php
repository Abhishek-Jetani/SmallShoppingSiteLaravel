<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\AdminCategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminCategoryRequest;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return AdminCategoryResource::collection($categories);
    }

    public function create()
    {
        return view('Admin.category.create');
    }
    
    public function store(AdminCategoryRequest $request)
    {
        try {
            $request->validated();
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $imagePath = storeImageDatabase($request->file('image'), 'public/images/category', 'Category');

            $category = new Category($request->all());
            $category->image = $imagePath;
            $category->save();
            
            return response()->json([ 'category' => $category , 'message' => 'category created'], 201);
            // return new AdminCategoryResource($category);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }

    public function show(Category $category)
    {
        return new AdminCategoryResource($category);
    }

    public function edit(Category $category)
    {
        return response()->json(new AdminCategoryResource($category));
    }

    public function update(AdminCategoryRequest $request, Category $category)
    {
        try {
            $request->validated();

            if ($request->hasFile('image')) {
                if ($category->image) {
                    deleteImageInStorage('public/images/category', $category->image);
                }
                $imagePath = storeImageDatabase($request->file('image'), 'public/images/category', 'Category');
                $category->image = $imagePath;
            }

            $category->update($request->all());
            $category->save();

            return response()->json([ 'category' => $category , 'message' => 'category updated'], 201);
            // return new AdminCategoryResource($category);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $id = $category->id;
            $products = Product::where('category_id', $id)->count();
            if ($products > 0) {
                return response()->json(['message' => 'First delete this category products!'], 400);
            } else {
                $result = deleteItem(Category::class, $id, 'public/images/category');

                if ($result['success']) {
                    return response()->json(['message' => 'Category deleted!']);
                } else {
                    return response()->json(['message' => 'error']);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong, please refresh the page'], 500);
        }
    }
}
