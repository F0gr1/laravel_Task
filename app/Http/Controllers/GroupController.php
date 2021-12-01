<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;

class GroupController extends Controller
{
    public function index()
    {
        // 自分のuserIdとgroup_leader_idが一致するレコードを渡す
        $userId = Auth::id();
        $groups = Group::table('groups')
        ->where('group_leader_id' , '=' , $userId)
        ->get();
        return view('Group/index', compact('groups'));
    }

    public function edit($groupId)
    {
        // 選択したグループのレコードとそのグループに所属するuserのレコードを渡す
        $group = Group::findOrFail($groupId);
        $user = User::table('users')
        ->where('group_id' , '=' , $groupId)
        ->get();
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
