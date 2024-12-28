<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Order::create([
            'order_code' =>  'MY/' . date('ymdHi') . '/0003/' . strtoupper(uniqid()),
            'user_id' => 3,
            'hotel_id' => 32,
            'check_in' => date('Y-m-d'),
            'check_out' => date('Y-m-d', strtotime('+2 days')),
            'total_room' => 1,
            'total' => 1360000,
            'status_bayar' => false,
        ]);
    }
}
