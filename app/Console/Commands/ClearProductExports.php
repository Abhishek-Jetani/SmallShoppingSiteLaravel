<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;




class ClearProductExports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:product_exports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears files in the product_export folder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'public/product_export';
        $files = Storage::files($directory);
        
        foreach ($files as $file) {
            Storage::delete($file);
            $this->info("Deleted: $file");
        }
        
        $this->info('All files in product_export folder have been deleted successfully.');
    }
}
