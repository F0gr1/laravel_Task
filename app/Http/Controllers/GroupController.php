<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;


class GroupController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $groups = Group::where('group_leader_id' , '=' , $userId)
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')
        ->get();
        return view('Group/index', compact('groups'));
    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);
        $userId = UserGroup::where('group_id' , '=' , $groupId)->get();
        $user = User::find($userId);
        return view('Group/edit', compact('group' , 'user'));
    }

    public function create($id)
    {
        $group = new Group();
        $user = Auth::user();
        $group->group_leader_id = $user->id;
        return view('Group/create', compact('group' , 'userName'));
    }

    public function update(Request $request , $id){
        $group = Group::findOrFail($id);
        $group->group_name = $request->group_name;
        $group->save();
        UserGroup::where('group_id', '=', $group->id)->delete();
        foreach($request->userId as $userId){
            $userGroup = new UserGroup();
            $userGroup->user_id = $userId;
            $userGroup->group_id = $group->id;
            $userGroup->save();
        }
        return redirect("Group/index");
    }

    public function store(Request $request){
        $group = new Group();
        $group->group_name = $request->group_name;
        $group->group_leader_id = Auth::id();
        $group->save();
        foreach($request->userId as $userId){
            $userGroup = new UserGroup();
            $userGroup->user_id = $userId;
            $userGroup->group_id = $group->id;
            $userGroup->save();
        }
        return redirect("Group/index");
    }

    public function delete($id)
    {
        try{
            Group::findOrFail($id)->delete();
            
        }catch(ModelNotFoundException $e){
            logger('test', ['$e']);
            App::abort(404);
        }
        return redirect("/home/group");
    }
}
