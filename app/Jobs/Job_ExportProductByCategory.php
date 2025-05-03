<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export_ProductsByCategory;

class Job_ExportProductByCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $categoryId;

    /**
     * Create a new job instance.
     */
    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }


    /**
     * Execute the job.
     */
    public function handle(): void 
    {       
        Excel::store(new Export_ProductsByCategory($this->categoryId['category_id']), 'product_export/products.xlsx', 'public');
    }
}


