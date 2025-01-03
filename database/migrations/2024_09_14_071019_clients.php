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
        Schema::create('clients', function (Blueprint $table){
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->unsignedInteger('store_id')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
