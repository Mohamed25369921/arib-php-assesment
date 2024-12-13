<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;
    protected $employeeRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->employeeRepository = $employeeRepository;
    }

    // List all tasks for a specific employee
    public function index()
    {
        $employee = auth()->user();
        $tasks = $this->taskRepository->getTasksByEmployeeId($employee->id);
        return view('tasks.index', compact('tasks', 'employee'));
    }

    public function selectEmployee()
    {
        $employees = $this->employeeRepository->getAllEmployees();
        return view('tasks.select-employee', compact('employees'));
    }

    // Show create task form
    public function create($employeeId)
    {
        $employee = $this->employeeRepository->getEmployeeById($employeeId);
        return view('tasks.create', compact('employee'));
    }

    // Store new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $this->taskRepository->createTask($validated);
        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
    }


    // Update task status
    public function updateStatus(Request $request, $id)
    {
        $status = $request->get('status');
        $this->taskRepository->updateTaskStatus($id, $status);
        return back()->with('success', 'Task status updated successfully.');
    }
}
