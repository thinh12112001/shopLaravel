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
        Schema::create('statistical', function (Blueprint $table) {
            $table->bigIncrements('id_statistical');
            $table->dateTime('order_date');
            $table->integer('sales');
            $table->integer('profit');
            $table->integer('quantity')->nullable();
            $table->integer('total_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistical');
    }
};
