<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request, TaskServices $taskServices): View
    {
        $tasks = $taskServices->index($request->user());

        return view('Task/index', compact('tasks'));
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('Task/edit', [
            'task' => $task,
            'userName' => request()->user(),
            'groups' => request()->user()->groups()->get(),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task, TaskServices $taskServices): RedirectResponse
    {
        $taskServices->update($task, $request->validated('task'));

        return redirect()->route('home');
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Task::class);

        return view('Task/create', [
            'task' => new Task(),
            'groups' => $request->user()->groups()->get(),
            'userName' => $request->user(),
        ]);
    }

    public function store(StoreTaskRequest $request, TaskServices $taskServices): RedirectResponse
    {
        $this->authorize('create', Task::class);

        $data = $request->validated();
        $groupIds = $data['group_id'] ?? [null];

        foreach ($groupIds as $groupId) {
            $taskServices->create($request->user(), $data['task'], $groupId);
        }

        return redirect()->route('home');
    }

    public function delete(Task $task, TaskServices $taskServices): RedirectResponse
    {
        $this->authorize('delete', $task);
        $taskServices->delete($task);

        return redirect()->route('home');
    }
}
