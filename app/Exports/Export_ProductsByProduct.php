<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class Export_ProductsByProduct implements FromCollection, WithHeadings, WithMapping, ShouldQueue
{

    protected $productIds;

    public function __construct($productIds)
    {
        $this->productIds = $productIds;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Product::with('category')->whereIn('id', $this->productIds)->get();
        return  Product::with('category')
            ->whereIn('id', $this->productIds)
            ->get();

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
}
