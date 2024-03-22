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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('CustomerID')->constrained('customer')->onDelete('cascade');
            $table->foreignId('EmployeeID')->constrained('employee')->onDelete('cascade');
            $table->integer('ord_status');
            $table->integer('ord_totalPrice');
            $table->timestamps();
        });

        Schema::create('orderDetail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('OrderID')->constrained('order')->onDelete('cascade');
            $table->foreignId('ProductID')->constrained('product')->onDelete('cascade');
            $table->integer('subtotal');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
