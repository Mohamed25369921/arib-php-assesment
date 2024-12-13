<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function getAllDepartments()
    {
        return Department::all();
    }

    public function getDepartmentById($id)
    {
        return Department::findOrFail($id);
    }

    public function createDepartment(array $data)
    {
        return Department::create($data);
    }

    public function updateDepartment($id, array $data)
    {
        $department = $this->getDepartmentById($id);
        $department->update($data);
        return $department;
    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);

        if ($department->employees()->count() > 0) {
            throw new \Exception('Cannot delete a department that has employees assigned.');
        }

        return $department->delete();
    }

    public function getAllDepartmentsWithStats()
    {
        return Department::withCount('employees')
            ->withSum('employees', 'salary')
            ->get();
    }
}
