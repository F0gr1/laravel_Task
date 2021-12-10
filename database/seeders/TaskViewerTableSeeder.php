<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TaskViewerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('task_viewers')->truncate();
        // 初期データ用意（列名をキーとする連想配列）
        for ($i = 1; $i <= 10; $i++) {
            $STasks = [
                        [
                            'userId' => '1',
                            'taskId' => $i,
                        ]
            ];
            DB::table('task_viewers')->insert($STasks);
        }
        // 登録

    }
}
