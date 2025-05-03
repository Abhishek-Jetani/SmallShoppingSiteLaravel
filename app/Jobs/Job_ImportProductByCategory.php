<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export_ProductsByCategory;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


use App\Imports\Import_ProductsByCategory;


class Job_ImportProductByCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $file = $this->filePath;
            if (Storage::exists($file)) {
                $import = new Import_ProductsByCategory($file);
                Excel::import($import, Storage::path($file));
                info('Import successful');
            } else {
                info('File not found: ' . $file);
            }
        } catch (\Exception $e) {
            info('Import failed: ' . $e->getMessage());
        }
    }
}
