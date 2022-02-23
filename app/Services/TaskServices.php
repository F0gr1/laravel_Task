<?php
namespace App\Services;

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

class TaskServices
{
    //
    public function index(){
        $userId = Auth::id();
        $tasks = DB::table('tasks')
        ->join('task_viewers as tv','tv.taskId','=','tasks.id')
        ->where('tv.userId' , '=' , $userId)
        ->paginate(7);
        return $tasks;
    }
    public function getTask(int $id){
        try{
            $task = Task::findOrFail($id);
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
            return $task;
    }
    public function getName(){
        return Auth::user();
    }
    public function getGroup(){
        $user_id = Auth::id();
        $groups = DB::table('groups')
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')        
        ->where('users_groups.user_id', '=' , $user_id)
        ->get();
        return $groups;
    }
    public function taskUpdate(Request $request ,int $id){
        try{
            $task = Task::findOrFail($id);
            return $task->fill($request->all())->save();
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
    }
    public function getGroups(int $user_id){
        $groups = DB::table('groups')
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')        
        ->where('users_groups.user_id', '=' , $user_id)
        ->get();
        return $groups;
    }
    public function taskStore( Request $request ){
        $task = new Task();
        $task->fill($request->all())->save();
        $user_id = Auth::id();
        // taskViewrStore($user_id);
    }
    public function taskGroupStore(  Request $request , int $groupId){
        $task = new Task();
        $task->task = $request->task;
        $task->user = $request->user;
        $task->group_id = $groupId;
        $task->save();
        $users=UsersGroup::where('group_id', '=', $groupId)->get();
        foreach($users as $user){
            $user_id = $user->id;
            // taskViewrStore($user_id);
        }

    }
    public function taskViewrStore($user_id){
        $task = DB::table('tasks')->orderby('id' , 'desc')->first();
        $viewer = new TaskViewer();
        $viewer->taskId = $task->id;
        $viewer->userId = $user_id;
        $viewer->save();
    }
}