<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function updateTask(array $data,Task $task){
        $final_data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        $task->update($final_data);
    }

}
