<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ShowTaskController extends Controller
{
    public function add(){
        $showTask = new ShowTask();
        $tasks = DB::table('tasks')->get();
        $users = DB::table('users')->get();
        return view('User/userAdd', compact('tasks' , 'users'));
    }
    public function store(Request $request)
    {
        $showTask = new ShowTask();
        $showTask-> taskId = $taskid;
        $showTask->userId =$userid;
        $showTask -> save();

        return redirect("/home");
    }
}
