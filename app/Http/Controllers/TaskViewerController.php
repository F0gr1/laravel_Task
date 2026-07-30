<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskViewerRequest;
use App\Models\Task;
use App\Models\TaskViewer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskViewerController extends Controller
{
    public function add(): View
    {
        $user = request()->user();
        $tasks = Task::query()
            ->where('user', $user->name)
            ->orWhereHas('group', function ($query) use ($user) {
                $query->where('group_leader_id', $user->id);
            })
            ->orderBy('id')
            ->get();

        return view('User/userAdd', [
            'tasks' => $tasks,
            'users' => User::query()->orderBy('name')->get(),
            'viewer' => new TaskViewer(),
        ]);
    }

    public function store(StoreTaskViewerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $task = Task::query()->findOrFail($data['task_id']);
        $this->authorize('manageViewers', $task);

        TaskViewer::query()->updateOrCreate(
            ['task_id' => $task->id, 'user_id' => $data['user_id']],
            []
        );

        return redirect()->route('home');
    }
}
