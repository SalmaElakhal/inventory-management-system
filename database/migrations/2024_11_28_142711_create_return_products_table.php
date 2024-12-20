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
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->integer('quantity');
            $table->date('date');
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_products');
    }
};
