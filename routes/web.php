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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\TaskController::class, 'index'])->name('home');
//Route::get('/home/{task}', [App\Http\Controllers\TaskController::class, 'show']);
Route::get('/home/create', [App\Http\Controllers\TaskController::class, 'create']);
Route::post('/home',[App\Http\Controllers\TaskController::class, 'store']);
Route::get('/home/{task}/edit' , [App\Http\Controllers\TaskController::class , 'edit']);
Route::put('/home/{task}' ,[App\Http\Controllers\TaskController::class , 'update']);
Route::Delete('home/{task}' , [App\Http\Controllers\TaskController::class , 'delete']);