<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\TaskViewer;
use App\Models\User;

class TaskViewerPolicy
{
    public function create(User $user, Task $task): bool
    {
        return $task->isManagedBy($user);
    }

    public function delete(User $user, TaskViewer $viewer): bool
    {
        return $viewer->isManagedBy($user);
    }
}
