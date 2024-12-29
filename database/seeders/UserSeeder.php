<?php

namespace Database\Seeders;

use App\Models\Saldo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('users')->truncate();
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'super@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        for ($i = 1; $i <= 2; $i++) {
            $users[] = [
                'name' => 'Member ' . $i,
                'email' => 'member' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
            ];
        }
        $reff = [
            'J9I4KD',
            'W9I8KI',
        ];
        foreach ($users as $key => $userData) {
            $user = User::create($userData);
            if ($key === 0) {
                $user->assignRole('super admin');
            } elseif ($key === 1 || $key === 2) {
                if ($key === 1) {
                    $user->ownReff()->create([
                        'reff_code' => $reff[0],
                    ]);
                } else {
                    $user->ownReff()->create([
                        'reff_code' => $reff[1],
                    ]);
                }
                $user->assignRole('admin');
            } else {
                $user->assignRole('member');
                Saldo::create([
                    'user_id' => $user->id,
                    'saldo' => $key === 2 ? 2000000 : 0,
                    'point' => 0,
                ]);
                if ($key === 3) {
                    $user->ownReff()->create([
                        'reff_code' => $this->generateRandomString()
                    ]);
                    $user->reffBy()->create([
                        'own_refferal_id' => 1
                    ]);
                } else {
                    $user->ownReff()->create([
                        'reff_code' => $this->generateRandomString()
                    ]);
                    $user->reffBy()->create([
                        'own_refferal_id' => 2
                    ]);
                }
            }
        }
    }
    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
