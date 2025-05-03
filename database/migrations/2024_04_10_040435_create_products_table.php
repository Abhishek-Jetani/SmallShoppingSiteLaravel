<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                
                // 'id', 'title', 'category_id' , 'image', 'short_desc', 'full_desc', 'status', 'price', 'quantity'
                $table->id();
                $table->string('title');
                $table->integer('category_id');
                $table->string('image')->default('custom_images/ProductLogo.jpg');
                $table->string('short_desc');
                $table->string('full_desc');
                $table->integer('status')->default('1');
                $table->integer('price');
                $table->integer('quantity');
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
