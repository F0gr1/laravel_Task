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
use Illuminate\Pagination\Paginator;

class GroupController extends Controller
{
    public function index()
    {

        // SELECT * FROM groups
        // LEFT OUTER JOIN (SELECT group_id, COUNT(*) FROM users_groups GROUP BY group_id)
        // ON id = group_id
        // 
        // groupsとその所属メンバーを渡すのではなく↑から作られる表一枚を渡したい。

        $userId = Auth::id();
        $groups = Group::where('group_leader_id' , '=' , $userId)

        ->get();
        $groupMembers = [];
        foreach($groups as $group){
            $groupId = $group->id;
            $groupMembers[$groupId] = UsersGroup::where('group_id', '=', $groupId)->count();
        }
        return view('Group/index', compact('groups', 'groupMembers'));
        // ->join('users_groups', 'groups.id', '=', 'users_groups.group_id')
        // ->paginate(7);
        // return view('Group/index', compact('groups'));

    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);
        // グループに所属しているユーザーを取得する
        // $usersGroups = UsersGroup::where('group_id' , '=' , $groupId)->get();
        // foreach($usersGroups as $usersGroup){
        //     $users = User::where('id', '=', $usersGroup->user_id);
        // }
        $users = User::get();
        return view('Group/edit', compact('group', 'users'));
    }

    public function create()
    {
        $group = new Group();
        $userId = Auth::id();
        $group->group_leader_id = $userid;
        $users = User::get();
        return view('Group/create', compact('group', 'users'));
    }

    public function update(Request $request, $groupid){
        $group = Group::findOrFail($groupid);
        $group->group_name = $request->group;
        $group->save();
        UsersGroup::where('group_id', '=', $group->id)->delete();
        foreach($request->userId as $userId){
            $userGroup = new UsersGroup();
            $userGroup->user_id = $userId;
            $userGroup->group_id = $group->id;
            $userGroup->save();
        }
        return $this->index();
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
