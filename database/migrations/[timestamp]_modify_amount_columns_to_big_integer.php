<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('top_ups', function (Blueprint $table) {
            $table->bigInteger('amount')->change();
        });

        Schema::table('saldos', function (Blueprint $table) {
            $table->bigInteger('saldo')->change();
            $table->bigInteger('point')->change();
        });
    }

    /**

     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('top_ups', function (Blueprint $table) {
            $table->integer('amount')->change();
        });

        Schema::table('saldos', function (Blueprint $table) {
            $table->integer('saldo')->change();
            $table->integer('point')->change();
        });
    }
};
