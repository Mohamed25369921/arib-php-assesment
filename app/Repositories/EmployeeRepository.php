<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::with('user')->get();
    }

    public function getEmployeeById($id)
    {
        return Employee::with('user')->findOrFail($id);
    }

    public function createEmployee(array $data)
    {
        // Create the user account
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Assign the "employee" role to the user
        $user->assignRole('employee');

        // Handle image upload if an image is provided
        if (isset($data['image'])) {
            $data['image'] = $this->storeImage($data['image']);
        }

        // Create the employee record and link it to the user
        $data['user_id'] = $user->id;
        return Employee::create($data);
    }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->getEmployeeById($id);

        // Update the linked user record
        $user = $employee->user;
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);

        // Handle image update
        if (isset($data['image'])) {
            // Delete old image if it exists
            if ($employee->image) {
                Storage::delete($employee->image);
            }
            // Store new image
            $data['image'] = $this->storeImage($data['image']);
        }

        // Update the employee-specific fields
        $employee->update([
            'salary' => $data['salary'],
            'department_id' => $data['department_id'],
            'manager_id' => $data['manager_id'],
            'image' => $data['image'] ?? $employee->image,
        ]);

        return $employee;
    }

    public function deleteEmployee($id)
    {
        $employee = $this->getEmployeeById($id);

        // Delete associated image if it exists
        if ($employee->image) {
            Storage::delete($employee->image);
        }

        // Delete the linked user record
        $employee->user->delete();

        return $employee->delete();
    }

    private function storeImage($image)
    {
        // Store the image in the "employees" directory and return the path
        return $image->store('employees', 'public');
    }
}
