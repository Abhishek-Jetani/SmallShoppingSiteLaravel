<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\AdminCategoryController;

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum' ], function () {
    
    Route::resource('category', AdminCategoryController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    
    Route::resource('product', AdminProductController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);
    Route::post('logout', [UserAuthController::class, 'logout']);
});
