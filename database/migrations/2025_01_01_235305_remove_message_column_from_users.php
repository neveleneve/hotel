<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'message')) {
                $table->dropColumn('message');
            }
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'message')) {
                $table->text('message')->nullable();
            }
        });
    }
};