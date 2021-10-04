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
        $tasks = [
                  ['task' => 'Test',
                   'User' => 'Vold43ST'],
                  ['task' => 'Test2',
                   'User'=> 'Shion'],
                 ];
    
        // 登録
        foreach($tasks as $task) {
          DB::table('tasks')->insert($task);
        }
    }
}
