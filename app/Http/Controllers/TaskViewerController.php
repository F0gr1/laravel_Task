<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskViewer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TaskViewerController extends Controller
{
    public function add(){
        $viewer = new TaskViewer();
        $tasks = Task::get();
        $users = User::get();
        return view('User/userAdd', compact('tasks' , 'users' , 'viewer'));
    }
    public function store(Request $request)
    {
        $viewer = new TaskViewer();
        $task = new Task();
        $viewer-> task_id = $request->task_id;
        $viewer-> user_id = $request->user_id;
        $viewer-> save();

        return redirect("/home");
    }
}
