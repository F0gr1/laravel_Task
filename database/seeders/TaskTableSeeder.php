<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        for ($i = 1; $i <= 10; $i++) {
          $tasks = [
                      [
                          'task' => 'name'.$i,
                          'user' => 'user'.$i,
                      ]
          ];
          DB::table('tasks')->insert($tasks);
      }
    }
}
