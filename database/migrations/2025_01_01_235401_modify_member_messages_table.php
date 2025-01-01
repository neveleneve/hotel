<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('member_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('member_messages', 'discount')) {
                $table->integer('discount')->default(0);
            }
            if (!Schema::hasColumn('member_messages', 'discount_status')) {
                $table->boolean('discount_status')->default(false);
            }

            // Ubah default value kolom active
            DB::statement('ALTER TABLE member_messages ALTER COLUMN active SET DEFAULT true');
        });
    }

    public function down(): void {
        Schema::table('member_messages', function (Blueprint $table) {
            DB::statement('ALTER TABLE member_messages ALTER COLUMN active SET DEFAULT false');
        });
    }
};
