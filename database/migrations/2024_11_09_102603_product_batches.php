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
        // shu yerda mahsulotlar kirib kelgan narxi, soni va sotilgandan keyin qolgan soni
        Schema::create('product_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->decimal('cost_price', 10, 2)->nullable(); // Mahsulotning kirim narxi
            $table->unsignedInteger('quantity')->nullable(); // Kirim qilingan miqdor
            $table->unsignedInteger('remaining_quantity')->nullable(); // Qolgan miqdor, FIFO hisoblash uchun
            $table->unsignedBigInteger('inventories_id')->nullable(); // Do'kon (agar mavjud bo'lsa)
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_batches');
    }
};
