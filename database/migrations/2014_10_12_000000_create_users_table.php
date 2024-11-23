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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->unsignedtinyInteger('role')->nullable(); // ['superadmin', 'admin', 'manager', 'cashier', 'suppliers]
            $table->unsignedTinyInteger('gender')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->unsignedtinyInteger('status')->nullable();
            $table->unsignedTinyInteger('address_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable(); // Kompaniya (agar mavjud bo'lsa)
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('passport')->nullable();
            $table->string('language', 4)->default('ru');
            $table->string('token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
