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
use Illuminate\Support\Facades\DB;
class GroupController extends Controller
{
    public function index()
    {

        $userId = Auth::id();
        $subQuery =  DB::table('users_groups')
                    ->select('group_id',  DB::raw('count(*) AS SUM'))
                    ->groupBy('group_id');
        $groups = DB::table('groups')
                    ->joinSub($subQuery, 'group_query', function ($join) {
                        $join->on('id', '=', 'group_query.group_id');
                    })
                    ->where('group_leader_id' , '=' , $userId)
                    ->paginate(7);
        return view('Group/index', compact('groups'));
    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);
        $users = User::get();
        return view('Group/edit', compact('group', 'users'));
    }

    public function create()
    {
        $group = new Group();
        $userId = Auth::id();
        $group->group_leader_id = $userId;
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
