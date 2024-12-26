<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
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
        ];

        // Add 10 members
        for ($i = 1; $i <= 5; $i++) {
            $users[] = [
                'name' => 'Member ' . $i,
                'email' => 'member' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
            ];
        }

        // Create roles array
        $roles = [
            'super admin',
            'admin',
            'member',
        ];

        // Create users and assign roles
        foreach ($users as $key => $userData) {
            $user = User::create($userData);
            // First user is super admin, second is admin, rest are members
            if ($key === 0) {
                $user->assignRole('super admin');
            } elseif ($key === 1) {
                $user->assignRole('admin');
            } else {
                $user->assignRole('member');
            }
        }
    }
}
