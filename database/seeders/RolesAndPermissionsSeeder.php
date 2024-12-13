<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'manage users',
            'manage employees',
            'manage departments',
            'manage tasks',
            'view tasks',
            'edit profile'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // Assign all permissions to the admin role
        $adminRole->syncPermissions(Permission::all());

        // Assign specific permissions to manager
        $managerRole->syncPermissions(['manage employees', 'manage departments', 'manage tasks', 'view tasks','edit profile']);

        // Assign specific permissions to employee
        $employeeRole->syncPermissions(['view tasks', 'edit profile']);
    }
}
