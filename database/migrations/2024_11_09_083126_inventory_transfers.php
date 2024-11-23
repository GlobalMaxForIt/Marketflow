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
        Schema::create('inventory_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable(); // Kompaniya
            $table->unsignedBigInteger('from_inventories_id')->nullable(); // Do'kon (agar mavjud bo'lsa)
            $table->unsignedBigInteger('to_inventories_id')->nullable(); // Do'kon (agar mavjud bo'lsa)
            $table->unsignedBigInteger('product_id')->nullable(); // Mahsulot
            $table->unsignedInteger('quantity')->default(0); // Miqdor
            $table->string('transfer_type')->nullable(); // Harakat turi: 'yetkazib berish', 'qaytarish', va h.k.
            $table->date('transfer_date')->nullable(); // Yetkazib berish sanasi
            $table->decimal('cost_price', 10, 2)->nullable(); // Mahsulotning narxi
            $table->decimal('total_cost', 10, 2)->nullable(); // Jami qiymat (miqdor * narx)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transfers');
    }
};
