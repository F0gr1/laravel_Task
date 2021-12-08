<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TaskTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(showTaskTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(UsersGroupsTableSeeder::class);
        
    }
}
