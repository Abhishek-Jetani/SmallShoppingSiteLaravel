<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// delete product in "product_exports" folder everyday 
Schedule::command('clear:product_exports')->everyMinute();
Schedule::command('app:clear-product-imports')->everyMinute();