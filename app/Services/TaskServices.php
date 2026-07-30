<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Task;
use App\Models\TaskViewer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskServices
{
    public function index(User $user)
    {
        return Task::query()
            ->visibleTo($user)
            ->with('viewers')
            ->latest('id')
            ->paginate(7);
    }

    public function create(User $owner, string $name, ?int $groupId = null): Task
    {
        return DB::transaction(function () use ($owner, $name, $groupId) {
            if ($groupId !== null) {
                $group = Group::query()->findOrFail($groupId);
                abort_unless(
                    $group->isManagedBy($owner) || $group->users()->whereKey($owner->id)->exists(),
                    403
                );
            }

            $task = new Task();
            $task->task = $name;
            $task->user = $owner->name;
            $task->group_id = $groupId;
            $task->save();

            $viewerIds = collect([$owner->id]);

            if ($groupId !== null) {
                $viewerIds = $viewerIds->merge(
                    Group::query()->findOrFail($groupId)->users()->pluck('users.id')
                );
            }

            foreach ($viewerIds->unique() as $userId) {
                TaskViewer::query()->firstOrCreate([
                    'task_id' => $task->id,
                    'user_id' => $userId,
                ]);
            }

            return $task;
        });
    }

    public function update(Task $task, string $name): bool
    {
        return $task->update(['task' => $name]);
    }

    public function delete(Task $task): void
    {
        DB::transaction(function () use ($task) {
            $task->viewers()->delete();
            $task->delete();
        });
    }
}
