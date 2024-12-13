<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function findUserById($id);
    public function createUser(array $data);
    public function updateUser(User $user, array $data): User;
    public function deleteUser($id): bool;
    public function assignRoleToUser(User $user, string $role): void;
    public function updateUserRole(User $user, string $role): void; // Add this
    public function updateOrCreateEmployeeDetails(User $user, array $employeeData): void; // Add this
    public function getAllManagers();
}
