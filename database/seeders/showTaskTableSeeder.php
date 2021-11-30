<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class showTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('show_tasks')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        for ($i = 1; $i <= 10; $i++) {
            $STasks = [
                        [
                            'userId' => '1',
                            'taskId' => $i,
                        ]
            ];
            DB::table('show_tasks')->insert($STasks);
        }
    
        // 登録

    }
}
