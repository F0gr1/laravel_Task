<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use App\Models\TaskViewer;
use App\Models\UsersGroup;
use App\Services\TaskServices;
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

    public function index(TaskServices $task_services)
    {
        $tasks = $task_services->index();
        return view('Task/index', compact('tasks'));
    }
    public function edit(int $id , TaskServices $task_services)
    {

        $task = $task_services->getTask($id);
        $userName = $task_services->getName();
        $groups = $task_services->getGroup();
        return view('Task/edit', compact('task' , 'userName' , 'groups'));
    }
    public function update(Request $request , int $id ,TaskServices $task_services){
        $task_services->taskUpdate($request , $id);
        return redirect("/home");
    }
    public function create(TaskServices $task_services)
    {
        // 空の$taskを渡す
        $user_id = Auth::id();
        $task = new Task();
        $groups = $task_services->getGroups($user_id);
        $userName = $task_services->getName();
        return view('Task/create', compact('task' , 'userName','groups'));
    }

    public function store(Request $request , TaskServices $task_services)
    {
        if(isset($request->group_id)){
            foreach($request->group_id as $groupId){
                $task_services->TaskGroupStore( $request , $groupId);
            }
        }else{
            $task_services->taskStore($request);
        }

        return redirect("/home");
    }
    public function delete(int $id , TaskServices $task_services)
    {
        $task_services-> taskDelete($id);
        return redirect("/home");
    }

}
