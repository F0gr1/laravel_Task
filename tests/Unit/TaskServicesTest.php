<?php

namespace Tests\Unit;

use App\Models\TaskViewer;
use App\Models\User;
use App\Services\TaskServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskServicesTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_delete_use_the_actual_task_id(): void
    {
        $owner = User::factory()->create(['email' => 'owner@example.com']);
        $services = app(TaskServices::class);

        $first = $services->create($owner, 'first');
        $second = $services->create($owner, 'second');

        $services->delete($first);

        $this->assertDatabaseMissing('tasks', ['id' => $first->id]);
        $this->assertDatabaseHas('tasks', ['id' => $second->id, 'task' => 'second']);
        $this->assertDatabaseMissing('task_viewers', ['task_id' => $first->id]);
        $this->assertDatabaseHas('task_viewers', ['task_id' => $second->id, 'user_id' => $owner->id]);
        $this->assertSame(1, TaskViewer::query()->where('task_id', $second->id)->count());
    }
}
