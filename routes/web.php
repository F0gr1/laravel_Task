<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskViewerController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/up', fn () => response()->json(['status' => 'ok']))->name('health');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [TaskController::class, 'index'])->name('home');
    Route::get('/home/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/home', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/home/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/home/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/home/{task}', [TaskController::class, 'delete'])->name('tasks.delete');

    Route::get('/home/task/{task}', [ProjectController::class, 'index'])->name('project');
    Route::get('/home/task/project/create/{task}', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/home/task/{task}', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/home/task/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/home/task/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/home/task/project/{project}', [ProjectController::class, 'delete'])->name('projects.delete');
    Route::get('/home/task/{project}/detail', [ProjectController::class, 'detail'])->name('projects.detail');

    Route::get('/home/group', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/home/group/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/home/group/store', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/home/group/edit/{group}', [GroupController::class, 'edit'])->name('groups.edit');
    Route::post('/home/group/update/{group}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/home/group/delete/{group}', [GroupController::class, 'delete'])->name('groups.delete');

    Route::get('/user/addPage', [TaskViewerController::class, 'add'])->name('task-viewers.create');
    Route::post('/user/add', [TaskViewerController::class, 'store'])->name('task-viewers.store');
});
