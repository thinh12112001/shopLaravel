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
        Schema::create('coupon', function (Blueprint $table) {
            $table->id('coupon_id');
            $table->string('coupon_name',150);
            $table->integer('coupon_time');
            $table->integer('coupon_condition');
            $table->integer('coupon_number');
            $table->string('coupon_code',50);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
