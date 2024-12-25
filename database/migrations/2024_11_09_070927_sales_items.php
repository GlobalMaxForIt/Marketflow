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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id'); // Sotuvga bog'lanish
            $table->unsignedBigInteger('product_id')->nullable(); // Sotilgan mahsulot
            $table->decimal('quantity', 8, 3)->unsigned()->default(0); // Sotilgan miqdor
            $table->decimal('cost_price', 10, 2)->unsigned()->nullable(); // Tannarx
            $table->decimal('price', 10, 2)->unsigned()->nullable(); // Sotuv narxi (bir dona)
            $table->tinyInteger('status')->nullable();
            $table->double('discount_price')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
