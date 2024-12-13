<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        //create Department
        $department = Department::create(['name' => 'Web']);

        //create Admin User
        $adminUser = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@system.com',
            'password' => bcrypt('password'), // Use a strong password in production
            'role' => 'admin',
        ]);
                
        $adminUser->assignRole('admin');

        //create Manager User
        $managerUser = User::create([
            'first_name' => 'Manager',
            'last_name' => 'User',
            'email' => 'manager@system.com',
            'password' => bcrypt('password'), // Use a strong password in production
            'role' => 'manager',
        ]);
                
        $managerUser->assignRole('manager');

        //create Employee User
        $employeeUser = User::create([
            'first_name' => 'Employee',
            'last_name' => 'User',
            'email' => 'employee@system.com',
            'password' => bcrypt('password'), // Use a strong password in production
            'role' => 'employee',
        ]);

        Employee::create([
            'user_id' => $employeeUser->id,
            'salary' => 120,
            'department_id' => $department->id, // Use a strong password in production
            'manager_id' => $managerUser->id,
        ]);
                
        $employeeUser->assignRole('employee');
    }
}
