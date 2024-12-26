<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HotelSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $countryMap = [
            'nz' => 1,
            'cn' => 2,
            'ch' => 3,
            'de' => 4,
            'gb' => 5,
            'it' => 6,
            'tr' => 7,
            'fr' => 8,
            'th' => 9,
            'sg' => 10,
            'in' => 11,
            'my' => 12,
            'vn' => 13,
            'kr' => 14,
            'jp' => 15,
            'au' => 16,
        ];

        $data = [];
        $hotelImagesPath = public_path('assets/img/hotel');
        $directories = File::directories($hotelImagesPath);

        foreach ($directories as $directory) {
            $countryCode = basename($directory);
            if (isset($countryMap[$countryCode])) {
                $countryId = $countryMap[$countryCode];
                $hotelImages = File::files($directory);
                foreach ($hotelImages as $image) {
                    $data[] = [
                        'name' => pathinfo($image, PATHINFO_FILENAME),
                        'country_id' => $countryId,
                        'price' => rand(100000, 1000000),
                        'rating' => rand(1, 5),
                        'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                        'promo' => rand(0, 1),
                        'discount' => rand(10, 20),
                    ];
                }
            }
        }
        dd($data[]);

        foreach ($data as $hotel) {
            Hotel::create($hotel);
        }
    }
}
