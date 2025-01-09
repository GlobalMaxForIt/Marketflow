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
        Schema::create('cashback', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('cashback_type_id')->nullable();
            $table->unsignedInteger('all_sum')->nullable();
            $table->unsignedInteger('taken_sum')->nullable();
            $table->unsignedInteger('left_sum')->nullable();
            $table->unsignedInteger('client_expenses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashback');
    }
};
