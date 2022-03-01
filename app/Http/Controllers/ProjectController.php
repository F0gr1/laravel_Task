<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ProjectController extends Controller
{
    public function index($id)
    {
        $Task = Task::findOrFail($id);
        $Projects = DB::table('projects')->where('task_id' , $id)->paginate(7);
        return view('Project/index', compact('Projects' , 'Task'));
    }
    public function detail($id){
        $Project = Project::findOrFail($id);
        return view('Project/detail',compact('Project'));

    }
    public function edit($id)
    {
        $Project = Project::findOrFail($id);
        $users = User::get();
        return view('Project/edit', compact('Project' , 'users'));
    }
    public function update(Request $request , $id)
    {
        $Projects = Project::findOrFail($id);
        $Projects->fill($request->all())->save();
        $task_id = $Projects->task_id;
        return  redirect('home/task/' . $task_id);
    }
    public function create($id)
    {
         // 空の$Projectを渡す
        $Project = new Project();
        $Task = Task::findOrFail($id);
        $users = User::get();

        return view('Project/create', compact('Project', 'Task' , 'users'));
    }

    public function store(Request $request)
    {
        $projects = new Project();
        $projects->fill($request->all())->save();
        $task_id = $Projects->task_id;
        return  redirect('home/task/' . $task_id);
    }
    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $task_id = $project->task_id;
        $project->delete();
        return  redirect('home/task/'.$task_id);
    }

}
