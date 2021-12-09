<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\UsersGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;


class GroupController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $groups = Group::where('group_leader_id' , '=' , $userId)
        ->get();
        $groupMembers = [];
        foreach($groups as $group){
            $groupId = $group->id;
            $groupMembers[$groupId] = UsersGroup::where('group_id', '=', $groupId)->count();
        }
        return view('Group/index', compact('groups','groupMembers'));
    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);
        $userId = UsersGroup::where('group_id' , '=' , $groupId)->get();
        $user = User::find($userId);
        return view('Group/edit', compact('group' , 'user'));
    }

    public function create()
    {
        $group = new Group();
        $user = Auth::user();
        $group->group_leader_id = $user->id;
        $users = User::get();
        return view('Group/create', compact('group','users'));
    }

    public function update(Request $request , $id){
        $group = Group::findOrFail($id);
        $group->group_name = $request->group_name;
        $group->save();
        UsersGroup::where('group_id', '=', $group->id)->delete();
        foreach($request->userId as $userId){
            $userGroup = new UsersGroup();
            $userGroup->user_id = $userId;
            $userGroup->group_id = $group->id;
            $userGroup->save();
        }
        return redirect("Group/index");
    }

    public function store(Request $request){
        $group = new Group();
        $group->group_name = $request->group;
        $group->group_leader_id = Auth::id();
        $group->save();
        foreach($request->userId as $userId){
            $userGroup = new UsersGroup();
            $userGroup->user_id = $userId;
            $userGroup->group_id = $group->id;
            $userGroup->save();
        }
        return $this->index();
    }

    public function delete($id)
    {
        try{
            Group::findOrFail($id)->delete();
            
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
        return redirect("/home/group");
    }
}
