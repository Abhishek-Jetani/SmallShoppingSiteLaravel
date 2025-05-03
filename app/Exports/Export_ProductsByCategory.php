<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;


class Export_ProductsByCategory implements FromCollection, WithHeadings, WithMapping, ShouldQueue
{

    public $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {     
        if ($this->categoryId == "all") {
            return Product::with('category')->get();
        } else {
            return Product::with('category')
            ->where('category_id', $this->categoryId)
            ->get();
        }
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Category Title',
            'Short Description',
            'Full Description',
            'Status',
            'Price',
            'Quantity',
            'Created At',
        ];
    }

    public function map($product): array
    {
        $status = $product->status == 1 ? 'Activate' : 'Deactivate';
        $createdAt = Carbon::parse($product->created_at)->format('d-m-Y');

        return [
            $product->id,
            $product->title,
            $product->category->title ?? 'N/A',
            $product->short_desc,
            $product->full_desc,
            $status,
            $product->price,
            $product->quantity,
            $createdAt,
        ];
    }

    // public function chunkSize(): int
    // {
    //     return 200; 
    // }


    
}
