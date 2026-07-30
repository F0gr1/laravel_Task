<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskViewer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->updateOrCreate(
            ['email' => 'demo@example.com'],
            ['name' => 'Demo User', 'password' => Hash::make(env('DEMO_USER_PASSWORD', 'password'))]
        );
        $user->forceFill([
            'email_verified_at' => now(),
            'email_verified' => true,
            'status' => 1,
        ])->save();

        $task = Task::query()
            ->where('task', 'Demo task')
            ->where('user', $user->name)
            ->first();

        if ($task === null) {
            $task = new Task();
            $task->task = 'Demo task';
            $task->user = $user->name;
            $task->save();
        }
        TaskViewer::query()->firstOrCreate([
            'task_id' => $task->id,
            'user_id' => $user->id,
        ]);

        Project::query()->firstOrCreate(
            ['task_id' => $task->id, 'project' => 'Demo project'],
            [
                'PIC' => $user->name,
                'progress' => 25,
                'memo' => 'Seed data for local development.',
                'start_date' => now()->toDateString(),
                'end_date' => now()->addDay()->toDateString(),
            ]
        );
    }
}
