<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;

class GroupPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, Group $group): bool
    {
        return $group->isManagedBy($user)
            || $group->users()->whereKey($user->id)->exists();
    }

    public function update(User $user, Group $group): bool
    {
        return $group->isManagedBy($user);
    }

    public function delete(User $user, Group $group): bool
    {
        return $group->isManagedBy($user);
    }
}
