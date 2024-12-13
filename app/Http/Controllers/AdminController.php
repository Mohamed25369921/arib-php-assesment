<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Task;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $employeeCount = Employee::count();
        $departmentCount = Department::count();
        $taskCount = Task::count();

        return view('admin.dashboard', compact('userCount', 'employeeCount', 'departmentCount', 'taskCount'));
    }
}
