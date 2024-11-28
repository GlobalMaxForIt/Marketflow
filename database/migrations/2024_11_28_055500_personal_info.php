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
        Schema::create('personal_info', function (Blueprint $table) {
            $table->id();
            $table->string('middlename')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedTinyInteger('gender')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->unsignedTinyInteger('address_id')->nullable();
            $table->string('passport')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
