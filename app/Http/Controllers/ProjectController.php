<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index()
    {
        $Projects = Project::all();
        return view('Project/index', compact('Projects'));
    }
    public function edit()
    {

    }
}
