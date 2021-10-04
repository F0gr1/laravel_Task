<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::all();
        return view('Task/index', compact('tasks'));
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // 取得した値をビュー「book/edit」に渡す
        return view('Task/edit', compact('task'));
    }
    public function update(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $task->task = $request->task;
        $task->User = $request->User;
        $task->save();

        return redirect("/home");
    }
    public function create()
{
    // 空の$bookを渡す
    $task = new Task();
    return view('Task/create', compact('task'));
}

    public function store(Request $request)
    {
        $task = new Task();
        $task->task = $request->task;
        $task->User = $request->User;
        $task->save();
    
        return redirect("/home");
    }
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect("/home");
    }

}
