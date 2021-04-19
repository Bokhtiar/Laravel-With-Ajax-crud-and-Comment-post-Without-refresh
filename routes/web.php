<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;

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
    $tasks = Task::all();
    return view('welcome',compact('tasks'));
});

Route::get('comment', [App\Http\Controllers\CommentController::class, 'create']);
Route::post('msg/store', [App\Http\Controllers\CommentController::class, 'store']);
Route::post('store', [App\Http\Controllers\TaskController::class, 'store']);
Route::post('update/task/{id}', [App\Http\Controllers\TaskController::class, 'update']);
