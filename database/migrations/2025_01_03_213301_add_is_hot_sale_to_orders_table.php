<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsHotSaleToOrdersTable extends Migration {
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_hot_sale')->default(false);
        });
    }


    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_hot_sale');
        });
    }
}
