<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('member_messages', function (Blueprint $table) {
            $table->integer('discount')->default(0);
            $table->boolean('discount_status')->default(false);
            $table->boolean('active')->default(true)->change();
        });
    }

    public function down(): void {
        Schema::table('member_messages', function (Blueprint $table) {
            $table->dropColumn(['discount', 'discount_status']);
            $table->boolean('active')->default(false)->change();
        });
    }
};
