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
        Schema::create('product_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->nullable(); // O'lchov birligi
            $table->text('description')->nullable(); // Tovar tavsifi (majburiy emas)
            $table->unsignedInteger('unit_id')->nullable(); // O'lchov birligi
            $table->json('images')->nullable();
            $table->unsignedTinyInteger('status')->nullable();
            $table->timestamp('manufactured_date')->nullable(); // ishlab chiqarilgan sana
            $table->timestamp('expired_date')->nullable(); // tugash muddati
            $table->timestamps(); // Yaratilgan va yangilangan vaqt
            $table->softDeletes(); // Yaratilgan va yangilangan vaqt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_info');
    }
};
