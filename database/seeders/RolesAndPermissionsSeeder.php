<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',

            'users.view',
            'users.create',
            'users.update',
            'users.delete',
            'roles.manage',

            'products.view',
            'products.create',
            'products.update',
            'products.delete',

            'catalog.manage',

            'suppliers.view',
            'suppliers.create',
            'suppliers.update',
            'suppliers.delete',

            'customers.view',
            'customers.create',
            'customers.update',
            'customers.delete',

            'warehouses.manage',
            'inventory.view',
            'inventory.adjust',
            'stock-movements.view',

            'purchases.view',
            'purchases.create',
            'purchases.update',
            'purchase-returns.create',

            'sales.view',
            'sales.create',
            'sales.return',
            'pos.access',

            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $cashier = Role::firstOrCreate(['name' => 'cashier']);
        $inventoryOfficer = Role::firstOrCreate(['name' => 'inventory-officer']);

        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'dashboard.view',

            'users.view',
            'users.create',
            'users.update',

            'products.view',
            'products.create',
            'products.update',
            'products.delete',

            'catalog.manage',

            'suppliers.view',
            'suppliers.create',
            'suppliers.update',
            'suppliers.delete',

            'customers.view',
            'customers.create',
            'customers.update',
            'customers.delete',

            'warehouses.manage',
            'inventory.view',
            'inventory.adjust',
            'stock-movements.view',

            'purchases.view',
            'purchases.create',
            'purchases.update',
            'purchase-returns.create',

            'sales.view',
            'sales.create',
            'sales.return',
            'pos.access',

            'reports.view',
        ]);

        $manager->syncPermissions([
            'dashboard.view',

            'products.view',
            'suppliers.view',
            'customers.view',

            'inventory.view',
            'stock-movements.view',

            'purchases.view',
            'sales.view',

            'reports.view',
        ]);

        $cashier->syncPermissions([
            'dashboard.view',
            'customers.view',
            'customers.create',
            'sales.view',
            'sales.create',
            'sales.return',
            'pos.access',
        ]);

        $inventoryOfficer->syncPermissions([
            'dashboard.view',

            'products.view',
            'products.create',
            'products.update',

            'catalog.manage',

            'suppliers.view',
            'suppliers.create',
            'suppliers.update',

            'warehouses.manage',
            'inventory.view',
            'inventory.adjust',
            'stock-movements.view',

            'purchases.view',
            'purchases.create',
            'purchases.update',
            'purchase-returns.create',
        ]);

        $defaultAdminEmail = 'admin@hardware-pos.test';

        $user = User::query()->firstOrCreate(
            ['email' => $defaultAdminEmail],
            [
                'name' => 'Super Admin',
                'password' => 'password',
            ]
        );

        if (! $user->hasRole('super-admin')) {
            $user->assignRole('super-admin');
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}