<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('carts', function (Blueprint $table) {
            $table->boolean('is_hot_sale')->default(false);
            $table->integer('member_message_id')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('member_message_id');
            $table->dropColumn('is_hot_sale');
        });
    }
};
