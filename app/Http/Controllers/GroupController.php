<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class GroupController extends Controller
{
    public function index()
    {
        // 自分のuserIdとgroup_leader_idが一致するレコードを渡す
        $userId = Auth::id();
        $groups = Group::where('group_leader_id' , '=' , $userId)
        ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')
        ->get();
        return view('Group/index', compact('groups'));
    }

    public function edit($groupId)
    {
        // 選択したグループのレコードとそのグループに所属するuserのレコードを渡す
        $group = Group::findOrFail($groupId);
        $userId = GroupUser::where('group_id' , '=' , $groupId)->get();
        $user = User::find($userId);
        return view('Group/edit', compact('group' , 'user'));
    }

    public function create($id)
    {
        // 空の$bookと自分のuserNameを渡す
        $group = new Group();
        $userName = Auth::user();
        return view('Group/create', compact('group' , 'userName'));
    }

    public function update(Request $request , $id){
        $group = Group::findOrFail($id);
        $group->group_name = $request->group_name;
        $group->save();
        return redirect("Group/index");
    }

    public function store(Request $request){
        $group = new Group();
        $group->group_name = $request->group_name;
        $group->save();
        return redirect("Group/index");
    }

    public function delete($id)
    {
        try{
            Group::findOrFail($id)->delete();
        }catch(ModelNotFoundException $e){
            App::abort(404);
        }
        return redirect("/home");
    }

}
