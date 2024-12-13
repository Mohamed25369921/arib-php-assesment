<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getTasksByEmployeeId($employeeId)
    {
        return Task::where('employee_id', $employeeId)->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTaskStatus($id, $status)
    {
        $task = Task::findOrFail($id);
        $task->status = $status;
        $task->save();
        return $task;
    }
}
