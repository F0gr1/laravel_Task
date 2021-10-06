<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index()
    {
        $Projects = Project::all();
        return view('Project/index', compact('Projects'));
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
        $Projects->start_date = $request->start_date;
        $Projects->end_date = $request->end_date;
        $Projects->save();

        return redirect("/home/task/{task}");
    }
    public function create()
    {
         // 空の$bookを渡す
        $Project = new Project();
        return view('Project/create', compact('Project'));
    }

    public function store(Request $request)
    {
        $Projects = new Project();
        $Projects->project = $request->project;
        $Projects->taskId = $request->taskId;
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
    
        return redirect("/home/{task}");
    }

}
