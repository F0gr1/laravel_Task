<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ShowTaskController extends Controller
{
    public function add(){
        $tasks = DB::table('tasks')->get();
        $users = DB::table('users')->get();
        return view('User/userAdd', compact('tasks' , 'users'));
    }
}
