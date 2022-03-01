<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use App\Models\User;
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
        $user_id = Auth::id();
        $tasks = task::find($user_id)->with('view')->paginate(7);
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
        $groups = User::find($user_id)->group()->get();
        
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
        $groups= User::find($user_id)->group()->get();
        return $groups;
    }
    public function taskStore( Request $request ){
        $task = new Task();
        $task->fill($request->all())->save();
        $user_id = Auth::id();
        $this->taskViewrStore($user_id);
    }
    public function taskGroupStore(  Request $request , int $groupId){
        $task = new Task();
        $task->task = $request->task;
        $task->user = $request->user;
        $task->group_id = $groupId;
        $task->save();
        $users=UsersGroup::where('group_id', '=', $groupId)->get();
        foreach($users as $user){
            $user_id = $user->user_id;
            $this->taskViewrStore($user_id);
        }

    }
    public function taskViewrStore(int $user_id){
        $task = DB::table('tasks')->orderby('id' , 'desc')->first();
        $viewer = new TaskViewer();
        $viewer->task_id = $task->id;
        $viewer->user_id = $user_id;
        $viewer->save();
    }
    public function taskDelete(int $id){
        try{
            Task::findOrFail($id)->delete();
            Taskviewer::findOrFail($id)->delete();
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
    }
}