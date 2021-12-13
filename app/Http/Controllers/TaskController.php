<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use App\Models\TaskViewer;
use Illuminate\Support\Facades\App; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();
        $tasks = DB::table('tasks')
        ->join('task_viewers as tv','tv.taskId','=','tasks.id')
        ->where('tv.userId' , '=' , $userId)
        ->paginate(7);
        return view('Task/index', compact('tasks'));
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $userName = Auth::user();
        // 取得した値をビュー「task/edit」に渡す
        $user_id = Auth::id();
        $groups = DB::table('groups')
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')        
        ->where('users_groups.user_id', '=' , $user_id)
        ->get();
        return view('Task/edit', compact('task' , 'userName' , 'groups'));

    }
    public function update(Request $request , $id){
        foreach($request->group_id as $groupId){
            $task = Task::findOrFail($id);
            $task->task = $request->task;
            $task->user = $request->user;
            $task->group_id = $groupId;
            $task->save();
        }
        return redirect("/home");
    }
    public function create()
    {
        // 空の$taskを渡す
        $user_id = Auth::id();
        $task = new Task();
        $groups = DB::table('groups')
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')        
        ->where('users_groups.user_id', '=' , $user_id)
        ->get();
        $userName = Auth::user();
        return view('Task/create', compact('task' , 'userName','groups'));
    }

    public function store(Request $request)
    {
        foreach($request->group_id as $groupId){
            $task = new Task();
            $task->task = $request->task;
            $task->user = $request->user;
            $task->group_id = $groupId;
            $task->save();
        }
        $taskId = DB::table('tasks')->orderby('id' , 'desc')->first();
        $viewer = new TaskViewer();
        $id = Auth::id();
        $viewer->taskId = $taskId->id;
        $viewer->userId = $id;
        $viewer->save();

        return redirect("/home");
    }
    public function delete($id)
    {
        try{
            Task::findOrFail($id)->delete();
            Taskviewer::findOrFail($id)->delete();
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
        return redirect("/home");
    }

}
