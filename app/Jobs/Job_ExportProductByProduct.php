<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export_ProductsByProduct;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class Job_ExportProductByProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $productIds;
    /**
     * Create a new job instance.
     */
    public function __construct($productIds)
    {
        $this->productIds = $productIds;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $productIds = $this->productIds;
        // $productsexport = new Export_ProductsByProduct($productIds);
        // $filePath = 'products_by_selected_'.$productIds.'.xlsx';
        // // dd($productsexport);
        // Excel::store($productsexport, $filePath, 'public');


        Excel::store(new Export_ProductsByProduct($this->productIds['product_ids']), 'product_export/products.xlsx', 'public');

    }
}
