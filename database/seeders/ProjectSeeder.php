<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->truncate();
        $projects =[
                        [
                            'taskId'=>'1',
                            'project'=>'テスト',
                            'User'=>'サトシ',
                            'memo'=>'テスト用のデータ',
                            'progress' => '0',
                            'start_date'=>'2021-10-15',
                            'end_date'=>'2021-10-16'
                        ],
                        [
                            'taskId'=>'2',
                            'project'=>'テスト2',
                            'User'=>'サトシ',
                            'memo'=>'テスト用のデータ',
                            'progress' => `100',
                            'start_date'=>'2021-10-15',
                            'end_date'=>'2021-10-16'
                        ]
            ];

        foreach($projects as $project) {
            DB::table('projects')->insert($project);
        }
    }
}
