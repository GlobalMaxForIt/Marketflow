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
        Schema::create('consignment_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_transfer_id'); // Bog'lanish
            $table->decimal('amount_due', 10, 2); // To'lanmagan qiymat
            $table->decimal('amount_paid', 10, 2); // To'lanmagan qiymat
            $table->date('due_date')->nullable(); // To'lov muddati
            $table->unsignedTinyInteger('status')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignment_records');
    }
};
