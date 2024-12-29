<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Generate the roles and permissions for the app.
     */
    public function run(): void
    {
        // Clear the permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $permissions = [
            'custom.*', // Custom model permission can go here, replace with any model name
            'user.*',
            'user.create',
            'user.update',
            'user.delete',
            'admin.create',
            'admin.update',
            'admin.delete',
        ];

        // Create permissions in the database
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Super Admin with all permissions
        $superAdminRole = Role::create(['name' => 'super admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin with restricted permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminPermissions = Permission::whereNotIn('name', ['admin.create', 'admin.update', 'admin.delete'])->get();
        $adminRole->givePermissionTo($adminPermissions);

        // Standard User with only custom permissions
        $userRole = Role::create(['name' => 'user']);
        $userPermissions = Permission::whereIn('name', [
            'custom.*',
        ])->get();
        $userRole->givePermissionTo($userPermissions);
    }
}
