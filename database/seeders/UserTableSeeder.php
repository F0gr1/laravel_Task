<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
                    [
                    'name' => 'admin',
                    'email' => 'task@task',
                    'password' => Hash::make('password')]
                ];

        DB::table('users')->insert($user);
    }
}
