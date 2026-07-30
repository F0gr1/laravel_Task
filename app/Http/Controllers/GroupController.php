<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): View
    {
        $user = request()->user();
        $groups = Group::query()
            ->withCount('users')
            ->where(function ($query) use ($user) {
                $query->where('group_leader_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->whereKey($user->id);
                    });
            })
            ->latest('id')
            ->paginate(7);

        return view('Group/index', compact('groups'));
    }

    public function edit(Group $group): View
    {
        $this->authorize('update', $group);

        return view('Group/edit', [
            'group' => $group->load('users'),
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('Group/create', [
            'group' => new Group(),
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateGroupRequest $request, Group $group): RedirectResponse
    {
        $group->update(['group_name' => $request->validated('group')]);
        $group->users()->sync($this->memberIds($request->validated('user_id', []), $group->group_leader_id));

        return redirect()->route('groups.index');
    }

    public function store(StoreGroupRequest $request): RedirectResponse
    {
        $this->authorize('create', Group::class);

        $group = DB::transaction(function () use ($request) {
            $group = Group::create([
                'group_name' => $request->validated('group'),
                'group_leader_id' => $request->user()->id,
            ]);
            $group->users()->sync($this->memberIds($request->validated('user_id', []), $request->user()->id));

            return $group;
        });

        return redirect()->route('groups.index')->with('status', "Group {$group->group_name} created.");
    }

    public function delete(Group $group): RedirectResponse
    {
        $this->authorize('delete', $group);

        DB::transaction(function () use ($group) {
            $group->load('users');
            $group->users()->detach();
            $group->tasks()->update(['group_id' => null]);
            $group->delete();
        });

        return redirect()->route('groups.index');
    }

    private function memberIds(array $memberIds, int $leaderId): array
    {
        return collect($memberIds)->push($leaderId)->unique()->values()->all();
    }
}
