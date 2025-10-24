<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('dish_id');
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->decimal('total_price', 10, 2);
    $table->timestamps();

    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
        });
    }

};
