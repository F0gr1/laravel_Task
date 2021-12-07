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
        for ($i = 1; $i <= 10; $i++){
            $user = [
                [
                'name' => 'admin'.$i,
                'email' => 'task'.$i.'@task',
                'password' => Hash::make('password')]
            ];
            DB::table('users')->insert($user);
        }
    }
}
