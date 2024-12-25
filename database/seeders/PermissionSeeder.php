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

            'role index',
            'role create',
            'role view',
            'role edit',
            'role delete',

            'permission index',
            'permission create',
            'permission view',
            'permission edit',
            'permission delete',
        ];

        $super = [
            'dashboard',
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
            'role index',
            'role create',
            'role view',
            'role edit',
            'role delete',
            'permission index',
            'permission create',
            'permission view',
            'permission edit',
            'permission delete',
        ];

        $admin = [
            'dashboard',
            'member index',
            'member view',
            'member edit',
            'hotel index',
            'hotel view',
            'hotel edit',
            'country index',
            'country create',
            'country view',
            'country edit',
            'order index',
            'order view',
            'order edit',
            'order delete',
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
