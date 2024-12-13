<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::with('employee')->get();
    }

    public function findUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data): User
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function updateUser(User $user, array $data): User
    {
        $updateData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => $data['role'],
            'email' => $data['email'],
        ];

        // Only update the password if it is provided
        if (!empty($data['password'])) {
            $updateData['password'] = bcrypt($data['password']);
        }

        $user->update($updateData);

        return $user;
    }


    public function updateOrCreateEmployeeDetails(User $user, array $employeeData): void
    {
        if ($user->hasRole('employee')) {
            $user->employee()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'salary' => $employeeData['salary'],
                    'department_id' => $employeeData['department_id'],
                    'manager_id' => $employeeData['manager_id'],
                ]
            );
        } else {
            $user->employee()->delete();
        }
    }


    public function deleteUser($id): bool
    {
        $user = $this->findUserById($id);
        return $user->delete();
    }

    public function assignRoleToUser(User $user, string $role): void
    {
        $user->syncRoles([$role]);
    }

    public function updateUserRole(User $user, string $role): void
    {
        $user->syncRoles([$role]);
    }

    public function getAllManagers()
    {
        return User::role('manager')->get();
    }
}
