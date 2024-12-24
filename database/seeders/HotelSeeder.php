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
                'rating' => 3.5,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
            [
                'name' => 'Hotel Komune Living & Wellness Kuala Lumpur',
                'country_id' => 12,
                'price' => 630000,
                'rating' => 4.4,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
            [
                'name' => 'KL Season Apartment At Times Square',
                'country_id' => 12,
                'price' => 890000,
                'rating' => 4.2,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
            [
                'name' => 'Santa Grand Signature Kuala Lumpur',
                'country_id' => 12,
                'price' => 450000,
                'rating' => 4.1,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
            [
                'name' => 'Star Residence Suite KLCC',
                'country_id' => 12,
                'price' => 300000,
                'rating' => 3.7,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
            [
                'name' => 'Wyndham Grand Bangsar Kuala Lumpur',
                'country_id' => 12,
                'price' => 670000,
                'rating' => 4.6,
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
            ],
        ];

        for ($i = 0; $i < count($data); $i++) {
            Hotel::create($data[$i]);
        }
    }
}
