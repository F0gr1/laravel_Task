<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
class ProjectController extends Controller
{
    public function index($id)
    {
        $Task = Task::findOrFail($id);
        $Projects = DB::table('projects')->where('taskId' , $id)->get();
        return view('Project/index', compact('Projects' , 'Task'));
    }
    public function edit($id)
    {
        $Project = Project::findOrFail($id);
        // 取得した値をビュー「book/edit」に渡す
        return view('Project/edit', compact('Project'));
    }
    public function update(Request $request , $id)
    {
        $Projects = Project::findOrFail($id);
        $Projects->project = $request->project;
        $Projects->User = $request->User;
        $Projects->memo = $request->memo;
        $Projects->progress= $request->progress;
        $Projects->start_date = $request->start_date;
        $Projects->end_date = $request->end_date;
        $Projects->save();

        return redirect("/home");
    }
    public function create($id)
    {
         // 空の$bookを渡す
        $Project = new Project();
        $Task = Task::findOrFail($id);
        return view('Project/create', compact('Project', 'Task'));
    }

    public function store(Request $request)
    {
        $Projects = new Project();
        $Projects->project = $request->project;
        $Projects->taskId = $request->taskId;
        $Projects->memo = $request->memo;
        $Projects->progress = $request->progress;
        $Projects->User = $request->User;
        $Projects->start_date = $request->start_date;
        $Projects->end_date = $request->end_date;
        $Projects->save();
        return redirect("/home");
    }
    public function delete($id)
    {
        $task = Project::findOrFail($id);
        $task->delete();
    
        return redirect("/home/");
    }

}
