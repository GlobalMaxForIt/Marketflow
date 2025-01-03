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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('cashier_id');
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('gift_card_percent')->nullable();
            $table->unsignedInteger('gift_card_sum')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->unsignedInteger('client_discount_price')->nullable();
            $table->decimal('paid_amount', 10, 2)->default(0); // Mijoz to'lagan summa
            $table->decimal('return_amount', 10, 2)->default(0); // Qaytarilgan summa (zda)
            $table->decimal('debt_amount', 10, 2)->default(0); // Qaytarilgan summa (zda)
            $table->string('code', 20)->nullable(); // Qaytarilgan summa (zda)
            $table->unsignedSmallInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
