<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getTasksByEmployeeId($employeeId);
    public function createTask(array $data);
    public function updateTaskStatus($id, $status);
}
