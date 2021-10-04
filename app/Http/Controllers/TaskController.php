<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::all();
        return view('Task/index', compact('tasks'));
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // 取得した値をビュー「book/edit」に渡す
        return view('Task/edit', compact('task'));
    }
}
