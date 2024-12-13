<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Repositories\DepartmentRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $employeeRepository;
    protected $departmentRepository;

    public function __construct(
        UserRepository $userRepository,
        EmployeeRepository $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $departments = $this->departmentRepository->getAllDepartments();
        $managers = $this->userRepository->getAllManagers();

        return view('users.create', compact('departments', 'managers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                Password::min(8) // Minimum 8 characters
                    ->letters() // At least one letter
                    ->mixedCase() // At least one uppercase and one lowercase letter
                    ->numbers() // At least one number
                    ->symbols(), // At least one special character
            ],
            'role' => 'required|in:admin,manager,employee',
            'salary' => 'nullable|numeric|required_if:role,employee',
            'department_id' => 'nullable|exists:departments,id|required_if:role,employee',
            'manager_id' => 'nullable|exists:users,id|required_if:role,employee',
        ]);

        $user = $this->userRepository->createUser($validated);
        $this->userRepository->assignRoleToUser($user, $validated['role']);
        if ($validated['role'] === 'employee') {
            $this->employeeRepository->createEmployee([
                'user_id' => $user->id,
                'salary' => $validated['salary'],
                'department_id' => $validated['department_id'],
                'manager_id' => $validated['manager_id'],
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $departments = $this->departmentRepository->getAllDepartments();
        $managers = User::where('role','manager')->where('id','!=',$user->id)->get();

        return view('users.edit', compact('user', 'departments', 'managers'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'role' => 'required|in:admin,manager,employee',
            'salary' => 'nullable|numeric',
            'department_id' => 'nullable|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        $this->userRepository->updateUser($user, $validated);
        $this->userRepository->updateUserRole($user, $validated['role']);
        $this->userRepository->updateOrCreateEmployeeDetails($user, [
            'salary' => $validated['salary'],
            'department_id' => $validated['department_id'],
            'manager_id' => $validated['manager_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->deleteUser($id);
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
