<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        return Task::query()
            ->whereKey($task->getKey())
            ->visibleTo($user)
            ->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $task->isManagedBy($user);
    }

    public function delete(User $user, Task $task): bool
    {
        return $task->isManagedBy($user);
    }

    public function manageViewers(User $user, Task $task): bool
    {
        return $task->isManagedBy($user);
    }
}
