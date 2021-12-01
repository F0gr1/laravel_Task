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
Auth::routes(['verify' => true]);
//Task周り
Route::get('/home', [App\Http\Controllers\TaskController::class, 'index'])->name('home')->middleware('verified');;
Route::get('/home/create', [App\Http\Controllers\TaskController::class, 'create']);
Route::post('/home',[App\Http\Controllers\TaskController::class, 'store']);
Route::get('/home/{id}/edit' , [App\Http\Controllers\TaskController::class , 'edit']);
Route::put('/home/{id}' ,[App\Http\Controllers\TaskController::class , 'update']);
Route::Delete('home/{id}' , [App\Http\Controllers\TaskController::class , 'delete']);

Route::get('/home/task/{projectId}', [App\Http\Controllers\ProjectController::class, 'index'])->name('project');
Route::get('/home/task/project/create/{projectId}', [App\Http\Controllers\ProjectController::class, 'create']);
Route::post('/home/task/{projectId}',[App\Http\Controllers\ProjectController::class, 'store']);
Route::get('/home/task/{projectId}/edit' , [App\Http\Controllers\ProjectController::class , 'edit']);
Route::put('/home/task/{projectId}' ,[App\Http\Controllers\ProjectController::class , 'update']);
Route::Delete('home/task/project/{projectId}' , [App\Http\Controllers\ProjectController::class , 'delete']);
Route::get('home/task/{taskId}/detail' , [App\Http\Controllers\ProjectController::class, 'detail']);

// mail認証
Route::post('register/pre_check', [App\Http\Controllers\Auth\RegisterController::class,'pre_check'])->name('register.pre_check');
Route::get('register/verify/{token}', [App\Http\Controllers\Auth\RegisterController::class,'showForm']);
Route::post('register/main_register',[App\Http\Controllers\Auth\RegisterController::class,'mainRegister'])->name('register.main.registered');


Route::get('user/addPage',[App\Http\Controllers\ShowTaskController::class, 'add']);
Route::post('user/add',[App\Http\Controllers\ShowTaskController::class, 'store']);
