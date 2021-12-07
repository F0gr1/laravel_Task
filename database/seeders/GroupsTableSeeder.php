<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 初期データ用意（列名をキーとする連想配列）
        for ($i = 1; $i <= 10; $i++) {
          $groups = [
                      [
                          'group_name' => 'group_name'.$i,
                          'group_leader_id' => $i,
                      ]
          ];
          DB::table('groups')->insert($groups);
        }
    }
}
