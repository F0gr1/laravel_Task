<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\ShowTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ShowTaskController extends Controller
{
    public function add(){
        $showTasks = new ShowTask();
        $tasks = DB::table('tasks')->get();
        $users = DB::table('users')->get();
        return view('User/userAdd', compact('showTasks','tasks' , 'users'));
    }
    public function store(Request $request)
    {
        $showTask = new ShowTask();
        $task = new Task();
        $task->id = $request->id;
        $taskid =   $task -> id ;
        $userid = 2;
        $showTask-> taskId = $taskid;
        $showTask-> userId = $userid;
        $showTask -> save();

        return redirect("/home");
    }
}
