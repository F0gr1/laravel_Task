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
        $Projects = DB::table('projects')->where('taskId' , $id)->get();
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
        return back();
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
        $Projects = new Project();
        $Projects->fill($request->all())->save();
        return redirect("/home");
    }
    public function delete($id)
    {
        $task = Project::findOrFail($id);
        $task->delete();
    
        return redirect("/home/");
    }

}
