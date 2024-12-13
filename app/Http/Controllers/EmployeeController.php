<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class EmployeeController extends Controller
{
    protected $userRepository;
    protected $employeeRepository;
    protected $departmentRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    // List all employees
    public function index()
    {
        $employees = $this->employeeRepository->getAllEmployees();
        return view('employees.index', compact('employees'));
    }

    // Show create employee form
    public function create()
    {
        $departments = $this->departmentRepository->getAllDepartments();
        return view('employees.create', compact('departments'));
    }

    public function store(EmployeeStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['role'] = 'employee';

        $this->userRepository->createUser($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = $this->employeeRepository->getEmployeeById($id);
        $departments = $this->departmentRepository->getAllDepartments();
        return view('employees.edit', compact('departments','employee'));
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['role'] = 'employee';
        $this->userRepository->updateUser($this->userRepository->findUserById($id), $validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
