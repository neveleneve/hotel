<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'hotel_id' => 1,
                'name' => 'John Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Jane Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 2,
                'name' => 'John Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Jane Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 3,
                'name' => 'John Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 3,
                'name' => 'Jane Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 4,
                'name' => 'John Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 4,
                'name' => 'Jane Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 5,
                'name' => 'John Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
            [
                'hotel_id' => 5,
                'name' => 'Jane Doe',
                'star' => rand(35, 50) / 10,
                'comment' => 'Great hotel, great service'
            ],
        ];

        foreach ($data as $review) {
            Review::create($review);
        }
    }
}
