<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $project->task !== null && $project->task->isAccessibleTo($user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        return $project->task !== null && $project->task->isManagedBy($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->task !== null && $project->task->isManagedBy($user);
    }
}
