<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\taskviewer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TaskViewerController extends Controller
{
    public function add(){
        $viewer = new taskviewer();
        $tasks = Task::get();
        $users = User::get();
        return view('User/userAdd', compact('tasks' , 'users' , 'viewer'));
    }
    public function store(Request $request)
    {
        $viewer = new taskviewer();
        $task = new Task();
        $viewer-> taskId = $request->taskId;
        $viewer-> userId = $request->userId;
        $viewer-> save();

        return redirect("/home");
    }
}
