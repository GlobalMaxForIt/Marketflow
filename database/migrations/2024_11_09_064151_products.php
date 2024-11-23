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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('products_categories_id')->nullable(); // O'lchov birligi
            $table->string('name'); // Tovar nomi
            $table->unsignedInteger('price')->nullable();
            $table->string('amount')->nullable();
            $table->string('barcode')->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->unsignedInteger('store_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->timestamps(); // Yaratilgan va yangilangan vaqt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
