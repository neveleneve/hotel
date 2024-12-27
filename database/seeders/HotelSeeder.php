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
        $hotels = [
            [
                'id'          => '1',
                'name'        => 'Dorsett Melbourne',
                'country_id'  => '16',
                'price'       => '950000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/1.jpg'
            ],
            [
                'id'          => '2',
                'name'        => 'Oaks Melbourne on Market Hotel',
                'country_id'  => '16',
                'price'       => '210000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/2.jpg'
            ],
            [
                'id'          => '3',
                'name'        => 'Radisson On Flagstaff Gardens Melbourne',
                'country_id'  => '16',
                'price'       => '820000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/3.jpg'
            ],
            [
                'id'          => '4',
                'name'        => 'Rendezvous Hotel Melbourne',
                'country_id'  => '16',
                'price'       => '890000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/4.jpg'
            ],
            [
                'id'          => '5',
                'name'        => 'Travelodge Hotel Melbourne Docklands',
                'country_id'  => '16',
                'price'       => '650000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/5.jpg'
            ],
            [
                'id'          => '6',
                'name'        => 'Vibe Hotel Melbourne Docklands',
                'country_id'  => '16',
                'price'       => '210000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/6.jpg'
            ],
            [
                'id'          => '7',
                'name'        => 'Grand Prince Hotel Shin Takanawa',
                'country_id'  => '15',
                'price'       => '180000',
                'rating'      => '1',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/7.jpg'
            ],
            [
                'id'          => '8',
                'name'        => 'HOTEL GRAPHY Shibuya',
                'country_id'  => '15',
                'price'       => '630000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/8.jpg'
            ],
            [
                'id'          => '9',
                'name'        => 'KOKO HOTEL Ginza-1chome',
                'country_id'  => '15',
                'price'       => '250000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/9.jpg'
            ],
            [
                'id'          => '10',
                'name'        => 'MONday Apart Premium 銀座新富町',
                'country_id'  => '15',
                'price'       => '840000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/10.jpg'
            ],
            [
                'id'          => '11',
                'name'        => 'Richmond Hotel Premier Asakusa International',
                'country_id'  => '15',
                'price'       => '860000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/11.jpg'
            ],
            [
                'id'          => '12',
                'name'        => 'Sakura Cross Hotel Akihabara',
                'country_id'  => '15',
                'price'       => '400000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/12.jpg'
            ],
            [
                'id'          => '13',
                'name'        => 'Sakura Hotel Ikebukuro',
                'country_id'  => '15',
                'price'       => '410000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/13.jpg'
            ],
            [
                'id'          => '14',
                'name'        => 'Tmark City Hotel Tokyo Omori',
                'country_id'  => '15',
                'price'       => '850000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/14.jpg'
            ],
            [
                'id'          => '15',
                'name'        => 'Tokyo Bay Ariake Washington Hotel',
                'country_id'  => '15',
                'price'       => '420000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/15.jpg'
            ],
            [
                'id'          => '16',
                'name'        => 'Tokyo Prince Hotel',
                'country_id'  => '15',
                'price'       => '350000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/16.jpg'
            ],
            [
                'id'          => '17',
                'name'        => 'hotel MONday Asakusa',
                'country_id'  => '15',
                'price'       => '730000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/17.jpg'
            ],
            [
                'id'          => '18',
                'name'        => 'karaksa hotel premier Tokyo Ginza',
                'country_id'  => '15',
                'price'       => '670000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/18.jpg'
            ],
            [
                'id'          => '19',
                'name'        => 'Fairfield by Marriott Seoul',
                'country_id'  => '14',
                'price'       => '510000',
                'rating'      => '1',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/19.jpg'
            ],
            [
                'id'          => '20',
                'name'        => 'Four Points by Sheraton Seoul, Guro',
                'country_id'  => '14',
                'price'       => '840000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/20.jpg'
            ],
            [
                'id'          => '21',
                'name'        => 'Mutal Stay',
                'country_id'  => '14',
                'price'       => '950000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/21.jpg'
            ],
            [
                'id'          => '22',
                'name'        => 'Ramada by Wyndham Seoul Dongdaemun',
                'country_id'  => '14',
                'price'       => '380000',
                'rating'      => '1',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/22.jpg'
            ],
            [
                'id'          => '23',
                'name'        => 'Summit Hotel Seoul Dongdaemun',
                'country_id'  => '14',
                'price'       => '990000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/23.jpg'
            ],
            [
                'id'          => '24',
                'name'        => 'TwoTwo House',
                'country_id'  => '14',
                'price'       => '310000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/24.jpg'
            ],
            [
                'id'          => '25',
                'name'        => 'ibis Styles Ambassador Seoul Myeong-dong',
                'country_id'  => '14',
                'price'       => '280000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/25.jpg'
            ],
            [
                'id'          => '26',
                'name'        => 'Grand Service Apartment @ Times Square',
                'country_id'  => '12',
                'price'       => '660000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/26.jpg'
            ],
            [
                'id'          => '27',
                'name'        => 'Hotel Komune Living & Wellness Kuala Lumpur',
                'country_id'  => '12',
                'price'       => '190000',
                'rating'      => '1',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/27.jpg'
            ],
            [
                'id'          => '28',
                'name'        => 'KL Season Apartment At Times Square',
                'country_id'  => '12',
                'price'       => '830000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/28.jpg'
            ],
            [
                'id'          => '29',
                'name'        => 'Lotus Infinity Apartment At Times Square Kl',
                'country_id'  => '12',
                'price'       => '690000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/29.jpg'
            ],
            [
                'id'          => '30',
                'name'        => 'Santa Grand Signature Kuala Lumpur',
                'country_id'  => '12',
                'price'       => '890000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/30.jpg'
            ],
            [
                'id'          => '31',
                'name'        => 'Star Residence Suite KLCC',
                'country_id'  => '12',
                'price'       => '410000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/31.jpg'
            ],
            [
                'id'          => '32',
                'name'        => 'The Platinum KLCC By Loversuites',
                'country_id'  => '12',
                'price'       => '680000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/32.jpg'
            ],
            [
                'id'          => '33',
                'name'        => 'Wyndham Grand Bangsar Kuala Lumpur',
                'country_id'  => '12',
                'price'       => '630000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/33.jpg'
            ],
            [
                'id'          => '34',
                'name'        => 'Al Meroz Hotel Bangkok - The Leading Halal Hotel',
                'country_id'  => '9',
                'price'       => '1000000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/34.jpg'
            ],
            [
                'id'          => '35',
                'name'        => 'Centre Point Silom',
                'country_id'  => '9',
                'price'       => '920000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/35.jpg'
            ],
            [
                'id'          => '36',
                'name'        => 'Grand 5 Hotel & Plaza Sukhumvit Bangkok',
                'country_id'  => '9',
                'price'       => '970000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/36.jpg'
            ],
            [
                'id'          => '37',
                'name'        => 'Montien Riverside Hotel Bangkok',
                'country_id'  => '9',
                'price'       => '200000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/37.jpg'
            ],
            [
                'id'          => '38',
                'name'        => 'SKYVIEW Hotel Bangkok - Sukhumvit',
                'country_id'  => '9',
                'price'       => '620000',
                'rating'      => '4',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/38.jpg'
            ],
            [
                'id'          => '39',
                'name'        => 'Solitaire Bangkok Sukhumvit 11',
                'country_id'  => '9',
                'price'       => '910000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/39.jpg'
            ],
            [
                'id'          => '40',
                'name'        => 'The Continent Hotel Sukhumvit - Asok BTS Bangkok',
                'country_id'  => '9',
                'price'       => '760000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/40.jpg'
            ],
            [
                'id'          => '41',
                'name'        => 'Valia Hotel Bangkok',
                'country_id'  => '9',
                'price'       => '370000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/41.jpg'
            ],
            [
                'id'          => '42',
                'name'        => 'Divan Istanbul',
                'country_id'  => '7',
                'price'       => '650000',
                'rating'      => '5',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/42.jpg'
            ],
            [
                'id'          => '43',
                'name'        => 'Ramada Encore by Wyndham Istanbul Sisli',
                'country_id'  => '7',
                'price'       => '300000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/43.jpg'
            ],
            [
                'id'          => '44',
                'name'        => 'Taxim Suites Residences Istanbul',
                'country_id'  => '7',
                'price'       => '330000',
                'rating'      => '2',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/44.jpg'
            ],
            [
                'id'          => '45',
                'name'        => 'The Fox Hotel',
                'country_id'  => '7',
                'price'       => '850000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/45.jpg'
            ],
            [
                'id'          => '46',
                'name'        => 'Windsor Hotel & Convention Center Istanbul',
                'country_id'  => '7',
                'price'       => '210000',
                'rating'      => '3',
                'description' => 'lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Quisquam, quod.',
                'image'       => 'hotel/46.jpg'
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
