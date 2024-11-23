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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(); // Mahsulot
            $table->unsignedBigInteger('store_id')->nullable(); // Do'kon
            $table->unsignedInteger('organization_id')->nullable(); // Tashkilot
            $table->unsignedInteger('company_id')->nullable(); // Kompaniya
//            $table->unsignedInteger('size_id')->nullable(); // O'lcham (optional)
//            $table->unsignedInteger('color_id')->nullable(); // Rang (optional)
            $table->decimal('price', 10, 2)->default(0); // Tovar narxi
//            $table->timestamp('manufactured_date')->nullable(); // ishlab chiqarilgan sana
//            $table->timestamp('expired_date')->nullable(); // tugash muddati
            $table->unsignedTinyInteger('type')->default(1); // 1 do'konlar magazinlar uchun, 2 tashkilotlar magazinlar uchun, 3 Kompaniyalar magazinlar uchun
            $table->integer('stock_quantity')->default(0); // Zaxira miqdori
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
