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
            $table->unsignedInteger('quantity')->default(0); // Sotilgan miqdor
            $table->decimal('cost_price', 10, 2)->nullable(); // Tannarx
            $table->decimal('price', 10, 2)->nullable(); // Sotuv narxi (bir dona)
            $table->decimal('discount', 10, 2)->nullable(); // Chegirma (agar mavjud bo'lsa)
            $table->decimal('total', 10, 2)->default(0); // Jami summa (miqdor * narx - chegirma)
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
