<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users_groups')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
    for ($i = 1; $i <= 10; $i++) {
        $usersGroups = [
                    [
                        'user_id' => $i,
                        'group_id' => $i,
                    ]
        ];
        DB::table('users_groups')->insert($usersGroups);
        }
    }
}
