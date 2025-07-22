<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void {
        Schema::create('products', function(Blueprint $table){
            $table->uuid("id")->primary();
            $table->string('name', 100);
            $table->string('category')->nullable();
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('name_variant', 100);
            $table->integer('weight');
            $table->integer('selling_price');
            $table->integer('base_price');
            $table->integer('product_stock');
            $table->string('barcode');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_variants');
    }
};