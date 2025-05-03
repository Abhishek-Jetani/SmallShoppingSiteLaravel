<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AdminCategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('description', function ($row) {
                    return Str::limit($row->description, 50, '...');
                })                
                ->addColumn('image', function ($row) {
                    $url = asset('storage/images/category/' . $row->image);
                    return '<img src="' . $url . '" width="50px" height="50px" class="rounded" alt="Category Image" align="center" />';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<label class="badge text-bg-success"> Active </label>'
                        : '<label class="badge text-bg-danger"> Deactive </label>';
                })
                ->addColumn('action', function ($row) {
                    $btn =  "<a class='btn' href='" . route('category.show', $row->id) . "'><i class='fa fa-eye text-primary'></i></a>";
                    $btn .=  "<a class='btn' href='" . route('category.edit', $row->id) . "'><i class='fa fa-pencil text-dark'></i></a>";
                    $btn .= '<form action="' . route('admin.deleteCustomer', $row->id) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></button></form>';

                    return $btn;
                })
                ->filterColumn('title', function ($query, $keyword) {
                    $sql = "CONCAT(categories.title,'-',categories.description)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })

                ->orderColumn('title', function ($data, $order) {
                    $data->orderBy('title', $order);
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                })

                ->rawColumns(['title', 'description', 'image', 'status', 'action'])
                ->toJson();
        }
        return view('Admin.category.index');
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

            return redirect()->route('category.index')->with('success', 'Record created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show(Category $category)
    {
        return view('Admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('Admin.category.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, Category $category)
    {
        try {
            $request->validated();
            $category->update($request->all());

            if ($request->hasFile('image')) {
                if ($category->image) {
                    deleteImageInStorage('public/images/category', $category->image);
                }
                $imagePath = storeImageDatabase($request->file('image'), 'public/images/category', 'Category');
                $category->image = $imagePath;
            }
            $category->save();
            return redirect()->route('category.index')->with('success', 'Record updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $id = $category->id;
            $products = Product::where('category_id', $id)->count();
            if ($products > 0) {
                return redirect()->back()->with('error', 'First delete this category products!');
            } else {
                $result = deleteItem(Category::class, $id, 'public/images/category');
                if ($result['success']) {
                    return redirect()->route('category.index')->with('success', $result['message']);
                } else {
                    return redirect()->back()->with('error', $result['message']);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please refresh the page');
        }
    }
}
