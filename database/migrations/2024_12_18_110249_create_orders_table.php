<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->integer('user_id');
            $table->integer('hotel_id');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_room');
            $table->integer('total');
            $table->enum('status_pesan', ['pending', 'done'])->default('pending');
            $table->boolean('status_bayar')->default(false);
            $table->enum('status_cancel', ['none', 'pending', 'approve', 'reject'])->default('none');
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
