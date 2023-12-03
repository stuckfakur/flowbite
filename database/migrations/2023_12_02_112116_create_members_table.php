<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('street')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('regency_id');
            $table->boolean('subscriber')->default(false);
            $table->string('day_id')->default('8');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
