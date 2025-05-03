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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');  // Ensure this is unsignedBigInteger
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('status')->default('pending');

            $table->string('invoice_number');

            $table->integer('quantity')->default(1); // Default quantity to 1
            $table->bigInteger('total_price')->nullable()->default(1);

            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->bigInteger('mobile_no');

            $table->softDeletes();
            $table->timestamps();

            // Define foreign key constraints after defining columns
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
