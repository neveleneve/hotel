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
                'reff_code' => 'J9I4KD',
            ],
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('12345678'),
                'reff_code' => $this->generateRandomString(),
            ],
        ];

        for ($i = 1; $i <= 1; $i++) {
            $users[] = [
                'name' => 'Member ' . $i,
                'email' => 'member' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
                'reff_code' => 'J9I4KD',
            ];
        }
        foreach ($users as $key => $userData) {
            $user = User::create($userData);
            if ($key === 0) {
                $user->assignRole('super admin');
            } elseif ($key === 1 || $key === 2) {
                $user->assignRole('admin');
            } else {
                $user->assignRole('member');
                Saldo::create([
                    'user_id' => $user->id,
                    'saldo' => $key === 2 ? 2000000 : 0,
                    'point' => 0,
                ]);
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
