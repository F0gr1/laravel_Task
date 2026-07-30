<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Task $task): View
    {
        $this->authorize('view', $task);

        $projects = $task->projects()->latest('id')->paginate(7);

        return view('Project/index', [
            'Projects' => $projects,
            'Task' => $task,
        ]);
    }

    public function detail(Project $project): View
    {
        $this->authorize('view', $project);

        return view('Project/detail', ['Project' => $project]);
    }

    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        return view('Project/edit', [
            'Project' => $project,
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($request->validated());

        return redirect()->route('project', ['task' => $project->task_id]);
    }

    public function create(Task $task): View
    {
        $this->authorize('view', $task);
        $this->authorize('create', Project::class);

        return view('Project/create', [
            'Project' => new Project(['task_id' => $task->id]),
            'Task' => $task,
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreProjectRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('view', $task);
        $this->authorize('create', Project::class);

        $task->projects()->create($request->validated());

        return redirect()->route('project', ['task' => $task->id]);
    }

    public function delete(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);
        $taskId = $project->task_id;
        $project->delete();

        return redirect()->route('project', ['task' => $taskId]);
    }
}
