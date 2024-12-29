<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $permissions = [
            'dashboard',

            'admin index',
            'admin create',
            'admin view',
            'admin edit',
            'admin delete',

            'member index',
            'member view',
            'member edit',
            'member delete',

            'hotel index',
            'hotel create',
            'hotel view',
            'hotel edit',
            'hotel delete',

            'country index',
            'country create',
            'country view',
            'country edit',
            'country delete',

            'order index',
            'order create',
            'order view',
            'order edit',
            'order delete',

            'deposit index',
            'deposit update',

            'withdraw index',
            'withdraw update',

            'point index',
            'point update',
        ];

        $super = [
            'dashboard',

            'admin index',
            'admin create',
            'admin view',
            'admin edit',
            'admin delete',

            'member index',
            'member view',
            'member edit',

            'hotel index',
            'hotel create',
            'hotel view',
            'hotel edit',
            'hotel delete',

            'country index',
            'country create',
            'country view',
            'country edit',
            'country delete',

            'order index',
            'order create',
            'order view',
            'order edit',
            'order delete',

            'deposit index',
            'deposit update',

            'withdraw index',
            'withdraw update',

            'point index',
            'point update',
        ];

        $admin = [
            'dashboard',

            'member index',
            'member view',
            'member edit',

            'hotel index',
            'hotel view',

            'country index',
            'country create',
            'country view',
            'country edit',

            'order index',
            'order view',
            'order edit',
            'order delete',

            'deposit index',
            'deposit update',

            'withdraw index',
            'withdraw update',

            'point index',
            'point update',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        foreach ($super as $superpermission) {
            Permission::findByName($superpermission)->assignRole('super admin');
        }

        foreach ($admin as $adminpermission) {
            Permission::findByName($adminpermission)->assignRole('admin');
        }
    }
}
