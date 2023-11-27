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
        Schema::create('ms_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('street')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('regency_id');
            $table->text('notes')->nullable();
            $table->string('subscriber')->nullable();
            $table->foreignId('day_id')->default('0');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_users');
    }
};
