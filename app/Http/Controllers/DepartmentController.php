<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Repositories\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    // List all departments
    public function index()
    {
        $departments = $this->departmentRepository->getAllDepartmentsWithStats();
        return view('departments.index', compact('departments'));
    }

    // Show create department form
    public function create()
    {
        return view('departments.create_or_edit');
    }

    // Store new department
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $this->departmentRepository->createDepartment($data);
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Show edit department form
    public function edit($id)
    {
        $department = $this->departmentRepository->getDepartmentById($id);
        return view('departments.create_or_edit', compact('department'));
    }

    // Update department
    public function update(DepartmentRequest $request, $id)
    {
        $data = $request->validated();
        $this->departmentRepository->updateDepartment($id, $data);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    // Delete department
    public function destroy($id)
    {
        try {
            $this->departmentRepository->deleteDepartment($id);
            return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('departments.index')->with('error', $e->getMessage());
        }
    }
}
