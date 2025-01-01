<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('member_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('hotel_id');
            $table->integer('price');
            $table->integer('discount')->max;
            $table->boolean('discount_status')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('member_messages');
    }
};
