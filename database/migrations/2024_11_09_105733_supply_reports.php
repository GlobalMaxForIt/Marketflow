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
        Schema::create('supply_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable(); // Kompaniya
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('inventories_id')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('cost_price', 10, 2)->nullable(); // Tannarx
            $table->decimal('selling_price', 10, 2)->nullable(); // Sotish narxi
            $table->decimal('revenue', 10, 2)->nullable(); // Daromad
            $table->decimal('profit', 10, 2)->nullable(); // Foyda
            $table->date('supply_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_reports');
    }
};
