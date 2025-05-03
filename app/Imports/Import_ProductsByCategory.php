<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Illuminate\Support\Facades\File;

class Import_ProductsByCategory implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
{
    use Importable;

    protected $categories;
    protected $file;

    public function __construct($file)
    {
        $this->categories = Category::all()->keyBy('title');
        $this->file = $file;
    }

    public function model(array $row)
    {
        $category = $this->categories->get($row['category']);
        if (!$category) {
            return null;
        }

        if (Product::where('title', $row['title'])->where('category_id', $category->id)->exists()) {
            return null;
        }

        $status = $row['status'] == 'Activate' ? 1 : 0;


        return new Product([
            'title' => $row['title'],
            'category_id' => $category->id,
            'image' => $row['image'],
            'short_desc' => $row['short_desc'],
            'full_desc' => $row['full_desc'],
            'status' => $status,
            'price' => $row['price'],
            'quantity' => $row['quantity'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.title' => 'required',
            '*.category' => 'required|exists:categories,title',
            '*.image' => 'required',
            '*.short_desc' => 'required',
            '*.full_desc' => 'required',
            '*.status' => 'required|in:Activate,Deactivate',
            '*.price' => 'required|numeric',
            '*.quantity' => 'required|integer',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }

}
