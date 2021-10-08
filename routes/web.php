<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/' , 'login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\TaskController::class, 'index'])->name('home');
//Route::get('/home/{task}', [App\Http\Controllers\TaskController::class, 'show']);
Route::get('/home/create', [App\Http\Controllers\TaskController::class, 'create']);
Route::post('/home',[App\Http\Controllers\TaskController::class, 'store']);
Route::get('/home/{task}/edit' , [App\Http\Controllers\TaskController::class , 'edit']);
Route::put('/home/{task}' ,[App\Http\Controllers\TaskController::class , 'update']);
Route::Delete('home/{task}' , [App\Http\Controllers\TaskController::class , 'delete']);


Route::get('/home/task/{task}', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');
Route::get('/home/task/project/create/{task}', [App\Http\Controllers\ProjectController::class, 'create']);
Route::post('/home/task/{task}',[App\Http\Controllers\ProjectController::class, 'store']);
Route::get('/home/task/{project}/edit' , [App\Http\Controllers\ProjectController::class , 'edit']);
Route::put('/home/task/{project}' ,[App\Http\Controllers\ProjectController::class , 'update']);
Route::Delete('home/task/project/{project}' , [App\Http\Controllers\ProjectController::class , 'delete']);
