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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id'); // Sotuvga bog'lanish
            $table->unsignedBigInteger('sale_item_id'); // Sotuv mahsulotiga bog'lanish
            $table->unsignedBigInteger('product_id'); // Mahsulot
            $table->decimal('quantity', 10, 2); // Qaytarilgan miqdor
            $table->decimal('price', 10, 2); // Qaytarilgan mahsulot narxi
            $table->decimal('total_amount', 10, 2); // Umumiy qaytarilgan summa
            $table->text('reason')->nullable(); // Qaytarish sababi
            $table->unsignedBigInteger('cashier_id'); // Kim qaytarishni amalga oshirdi
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};