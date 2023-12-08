<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->string('orderBy');
            $table->foreignId('day_id');
            $table->timestamps();
        });

        Schema::create('orders_flowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('flower_id');
            $table->enum('type', ['normal', 'additional']);
            $table->integer('total');
            $table->timestamps();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('orders_flowers');
        Schema::dropIfExists('orders');
    }
};
