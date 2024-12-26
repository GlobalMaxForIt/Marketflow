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
            $table->unsignedBigInteger('sale_id')->unsigned()->nullable(); // Sotuvga bog'lanish
            $table->unsignedBigInteger('sale_item_id')->unsigned()->nullable(); // Sotuv mahsulotiga bog'lanish
            $table->unsignedBigInteger('product_id')->unsigned()->nullable(); // Mahsulot
            $table->decimal('quantity', 10, 2)->unsigned()->nullable(); // Qaytarilgan miqdor
            $table->decimal('price', 10, 2)->unsigned()->nullable(); // Qaytarilgan mahsulot narxi
            $table->text('reason')->nullable(); // Qaytarish sababi
            $table->unsignedBigInteger('cashier_id')->unsigned()->nullable(); // Kim qaytarishni amalga oshirdi
            $table->unsignedBigInteger('store_id')->unsigned()->nullable(); // Kim qaytarishni amalga oshirdi
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
