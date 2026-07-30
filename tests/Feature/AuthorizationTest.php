<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskViewer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_other_users_cannot_edit_or_delete_a_task(): void
    {
        $owner = $this->verifiedUser('owner@example.com');
        $other = $this->verifiedUser('other@example.com');
        $task = $this->task($owner, 'private task');

        $this->actingAs($other)->get(route('tasks.edit', $task))->assertForbidden();
        $this->actingAs($other)->put(route('tasks.update', $task), ['task' => 'changed'])->assertForbidden();
        $this->actingAs($other)->delete(route('tasks.delete', $task))->assertForbidden();
    }

    public function test_task_owner_can_update_a_task(): void
    {
        $owner = $this->verifiedUser('owner@example.com');
        $task = $this->task($owner, 'old task');

        $this->actingAs($owner)
            ->put(route('tasks.update', $task), ['task' => 'new task'])
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'task' => 'new task']);
    }

    public function test_projects_are_scoped_to_the_parent_task(): void
    {
        $owner = $this->verifiedUser('owner@example.com');
        $other = $this->verifiedUser('other@example.com');
        $task = $this->task($owner, 'private task');
        $project = Project::create([
            'task_id' => $task->id,
            'project' => 'project',
            'PIC' => $owner->name,
            'progress' => 0,
            'memo' => 'memo',
            'start_date' => '2026-01-01',
            'end_date' => '2026-01-02',
        ]);

        $this->actingAs($other)->get(route('projects.detail', $project))->assertForbidden();
        $this->actingAs($other)->delete(route('projects.delete', $project))->assertForbidden();
    }

    public function test_only_group_leaders_can_change_groups(): void
    {
        $leader = $this->verifiedUser('leader@example.com');
        $other = $this->verifiedUser('other@example.com');
        $group = Group::create(['group_name' => 'Team', 'group_leader_id' => $leader->id]);
        $group->users()->sync([$leader->id, $other->id]);

        $this->actingAs($other)
            ->post(route('groups.update', $group), ['group' => 'changed', 'user_id' => [$other->id]])
            ->assertForbidden();
    }

    public function test_only_task_managers_can_add_viewers(): void
    {
        $owner = $this->verifiedUser('owner@example.com');
        $other = $this->verifiedUser('other@example.com');
        $task = $this->task($owner, 'private task');

        $this->actingAs($other)
            ->post(route('task-viewers.store'), ['task_id' => $task->id, 'user_id' => $other->id])
            ->assertForbidden();

        $this->actingAs($owner)
            ->post(route('task-viewers.store'), ['task_id' => $task->id, 'user_id' => $other->id])
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('task_viewers', ['task_id' => $task->id, 'user_id' => $other->id]);
    }

    private function verifiedUser(string $email): User
    {
        $user = User::factory()->create(['email' => $email]);
        $user->forceFill([
            'email_verified_at' => now(),
            'email_verified' => true,
            'status' => 1,
        ])->save();

        return $user->fresh();
    }

    private function task(User $owner, string $name): Task
    {
        $task = new Task();
        $task->task = $name;
        $task->user = $owner->name;
        $task->save();

        TaskViewer::create(['task_id' => $task->id, 'user_id' => $owner->id]);

        return $task;
    }
}
