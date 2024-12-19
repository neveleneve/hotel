<?php

namespace Database\Seeders;

use App\Models\country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $data = [
            [
                'name' => 'New Zealand',
                'phone_code' => '64',
                'flag_code' => 'nz',
            ],
            [
                'name' => 'China',
                'phone_code' => '86',
                'flag_code' => 'cn',
            ],
            [
                'name' => 'Switzerland',
                'phone_code' => '41',
                'flag_code' => 'ch',
            ],
            [
                'name' => 'Germany',
                'phone_code' => '49',
                'flag_code' => 'de',
            ],
            [
                'name' => 'United Kingdom',
                'phone_code' => '44',
                'flag_code' => 'gb',
            ],
            [
                'name' => 'Italy',
                'phone_code' => '39',
                'flag_code' => 'it',
            ],
            [
                'name' => 'Turkey',
                'phone_code' => '90',
                'flag_code' => 'tr',
            ],
            [
                'name' => 'France',
                'phone_code' => '33',
                'flag_code' => 'fr',
            ],
            [
                'name' => 'Thailand',
                'phone_code' => '66',
                'flag_code' => 'th',
            ],
            [
                'name' => 'Singapore',
                'phone_code' => '65',
                'flag_code' => 'sg',
            ],
            [
                'name' => 'India',
                'phone_code' => '91',
                'flag_code' => 'in',
            ],
            [
                'name' => 'Malaysia',
                'phone_code' => '60',
                'flag_code' => 'my',
            ],
            [
                'name' => 'Vietnam',
                'phone_code' => '84',
                'flag_code' => 'vn',
            ],
            [
                'name' => 'South Korea',
                'phone_code' => '82',
                'flag_code' => 'kr',
            ],
            [
                'name' => 'Japan',
                'phone_code' => '81',
                'flag_code' => 'jp',
            ],
            [
                'name' => 'Australia',
                'phone_code' => '61',
                'flag_code' => 'au',
            ],
        ];


        for ($i = 0; $i < count($data); $i++) {
            country::create($data[$i]);
        }
    }
}
