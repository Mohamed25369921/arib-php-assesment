<?php

namespace App\Repositories;

interface DepartmentRepositoryInterface
{
    public function getAllDepartments();
    public function getDepartmentById($id);
    public function createDepartment(array $data);
    public function updateDepartment($id, array $data);
    public function deleteDepartment($id);
    public function getAllDepartmentsWithStats(); // To fetch department stats (employee count & salary sum)
}
