<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;



class ClearProductImports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-product-imports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears files in the import_files folder.';   // in the storage main folder

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'import_files';
        $files = Storage::files($directory);
        
        foreach ($files as $file) {
            Storage::delete($file);
            $this->info("Deleted: $file");
        }
        
        $this->info('All files in import_files folder have been deleted successfully.');
    }
}
