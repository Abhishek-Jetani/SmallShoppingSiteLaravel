<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Jobs\Job_ExportProductByProduct;
use App\Jobs\Job_ExportProductByCategory;
use App\Jobs\Job_ImportProductByCategory;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminProductRequest;
use Yajra\DataTables\DataTables;


class AdminProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {
            $categoryId = $request->input('category_id');
            $data = Product::with('category');

            if ($categoryId !== 'all') {
                $data->where('category_id', $categoryId);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="productCheckbox" data-id="' . $row . '" />';
                })
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('image', function ($row) {
                    $url = asset('storage/images/product/' . $row->image);
                    return '<img src="' . $url . '" width="50px" height="50px" class="rounded" alt="Product Image" align="center" />';
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->title;
                })
                ->addColumn('price', function ($row) {
                    return $row->price;
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<label class="badge text-bg-success"> Active </label>'
                        : '<label class="badge text-bg-danger"> Deactive </label>';
                })
                ->addColumn('action', function ($row) {
                    $btn = "<a class='btn' href='" . route('product.show', $row->id) . "'><i class='fa fa-eye text-primary'></i></a>";
                    $btn .= "<a class='btn' href='" . route('product.edit', $row->id) . "'><i class='fa fa-pencil text-dark'></i></a>";
                    $btn .= '<form action="' . route('product.destroy', $row->id) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn delete-btn"><i class="fa fa-trash text-danger"></i></button></form>';

                    return $btn;
                })
                ->orderColumn('title', function ($data, $order) {
                    $data->orderBy('title', $order);
                })
                ->filterColumn('title', function($query, $keyword) {
                    $sql = "CONCAT(products.title,'-',products.price, '-', products.quantity)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                })

                ->rawColumns(['checkbox', 'title', 'image', 'category_name', 'status', 'price', 'quantity', 'action'])
                ->toJson();
        }
        return view('Admin.product.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.product.create', compact('categories'));
    }

    public function store(AdminProductRequest $request)
    {
        try {
            $request->validated();
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $imagePath = storeImageDatabase($request->file('image'), 'public/images/product', 'Product');
            $product = new Product($request->all());
            $product->image = $imagePath;
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product added successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show(Product $product)
    {
        return view('Admin.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('Admin.product.edit', compact('product', 'categories'));
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
            $product->quantity = $product->quantity + $request->quantity;
            $product->title = $request->title;
            $product->short_desc = $request->short_desc;
            $product->full_desc = $request->full_desc;
            $product->category_id = $request->category_id;
            $product->status = $request->status;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->save();

            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy($id)
    {
        try {

            $result = deleteItem(Product::class, $id, 'public/images/product');

            if ($result['success']) {
                return redirect()->route('product.index')->with('success', $result['message']);
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please refresh the page');
        }
    }

    public function deleteMultiple(Request $request)
    {
        try {

            $request->validate([
                'product_ids' => 'required|array|min:1',
            ]);
            $product_ids = $request->input('product_ids', []);
            if ($product_ids > 0) {
                foreach ($product_ids as $id) {
                    $product = Product::findOrFail($id);
                    $product->delete();
                }
            }
            return response()->json(['success' => true,], 200);
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with('error', 'Something went wrong, please refresh the page');
        }
    }

    public function export(Request $request)
    {
        if ($request->has('product_ids')) {
            $data = [
                'product_ids' => $request->input('product_ids')
            ];
            dispatch(new Job_ExportProductByProduct($data));
            $url = Storage::disk('public')->url('product_export/products.xlsx');
            return response()->json(['download_url' => $url]);
        } elseif ($request->has('category_id')) {
            $data = [
                'category_id' => $request->input('category_id')
            ];
            dispatch(new Job_ExportProductByCategory($data));
            $url = Storage::disk('public')->url('product_export/products.xlsx');
            return response()->json(['download_url' => $url]);
        } else {
            return response()->json(['error' => 'No product IDs or category ID provided'], 400);
        }
        return response()->json();
    }

    public function downloadExcel()
    {
        $filePath = 'product_export/products.xlsx';
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if ($request->ajax()) {
                $file = $request->file('file');
                $spreadsheet = IOFactory::load($file->getPathname());

                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                if (empty($rows) || !isset($rows[0])) {
                    return response()->json(['errors' => ['file' => ['The file is empty or invalid.']]], 422);
                }

                $header = array_map('strtolower', $rows[0]);
                $requiredColumns = ['title', 'category', 'image', 'short_desc', 'full_desc', 'status', 'price', 'quantity'];

                $errors = [];
                foreach ($requiredColumns as $column) {
                    if (!in_array($column, $header)) {
                        $errors['file'][] = $column . ' column is missing in the uploaded file.';
                    }
                }

                if (!empty($errors)) {
                    return response()->json(['errors' => $errors], 422);
                }

                $headerMap = array_flip($header);

                for ($i = 1; $i < count($rows); $i++) {
                    $row = $rows[$i];
                    $rowErrors = [];

                    $categoryTitle = $row[$headerMap['category']];
                    $category = Category::where('title', $categoryTitle)->first();
                    if (!$category) {
                        $rowErrors['category'] = 'Row ' . ($i + 1) . ' ("' . $row[$headerMap['title']] . '"): Category "' . $categoryTitle . '" does not exist.';
                    }

                    $status = $row[$headerMap['status']];
                    if (!in_array($status, ['Activate', 'Deactivate'])) {
                        $rowErrors['status'] = 'Row ' . ($i + 1) . ' ("' . $row[$headerMap['title']] . '"): Status should be either "Activate" or "Deactivate".';
                    }

                    if (!is_numeric($row[$headerMap['price']])) {
                        $rowErrors['price'] = 'Row ' . ($i + 1) . ' ("' . $row[$headerMap['title']] . '"): Price should be a number.';
                    }

                    if (!is_numeric($row[$headerMap['quantity']])) {
                        $rowErrors['quantity'] = 'Row ' . ($i + 1) . ' ("' . $row[$headerMap['title']] . '"): Quantity should be a number.';
                    }

                    $productName = $row[$headerMap['title']];
                    if ($category) {
                        $existingProduct = Product::where(['title' => $productName, 'category_id' => $category->id])->first();
                        if ($existingProduct) {
                            continue;
                        }
                    }
                    if (!empty($rowErrors)) {
                        $errors['row_' . ($i + 1)] = $rowErrors;
                    }
                }

                if (!empty($errors)) {
                    return response()->json(['errors' => $errors], 422);
                }

                $filePath = $request->file('file')->store('uploads');
                dispatch(new Job_ImportProductByCategory($filePath));

                return response()->json(['success' => true], 200);
            } else {
                return redirect()->route('admin.product.index');
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => ['file' => [$e->getMessage()]]], 500);
        }
    }
}
