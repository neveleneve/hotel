<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'name' => 'Grand Service Apartment @ Times Square',
                'country_id' => 12,
                'price' => 600000,
                'description' => '',
            ],
            [
                'name' => 'Hotel Komune Living & Wellness Kuala Lumpur',
                'country_id' => 12,
                'price' => 630000,
                'description' => '',
            ],
            [
                'name' => 'KL Season Apartment At Times Square',
                'country_id' => 12,
                'price' => 890000,
                'description' => '',
            ],
            [
                'name' => 'Santa Grand Signature Kuala Lumpur',
                'country_id' => 12,
                'price' => 450000,
                'description' => '',
            ],
            [
                'name' => 'Star Residence Suite KLCC',
                'country_id' => 12,
                'price' => 300000,
                'description' => '',
            ],
            [
                'name' => 'Wyndham Grand Bangsar Kuala Lumpur',
                'country_id' => 12,
                'price' => 670000,
                'description' => '',
            ],
        ];

        for ($i = 0; $i < count($data); $i++) {
            Hotel::create($data[$i]);
        }
    }
}
