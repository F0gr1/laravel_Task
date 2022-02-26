<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskViewer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_viewers', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->references('id')->on('users');;
            $table->integer('taskId')->references('id')->on('task');;      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_viewers');
    }
}
