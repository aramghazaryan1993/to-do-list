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
    return redirect('home');
});

Auth::routes();

Route::get('get-to-do-list', [App\Http\Controllers\ToDoListController::class, 'getToDoList'])->name('get.to.do.list');

Route::get('get-to-do-listt', [App\Http\Controllers\ToDoListController::class, 'getToDoListt'])->name('get.to.do.listt');

Route::post('add-to-do-list', [App\Http\Controllers\ToDoListController::class, 'addToDoList'])->name('add.to.do.list');
Route::post('delete-to-do-list', [App\Http\Controllers\ToDoListController::class, 'deleteToDoList'])->name('delete.to.do.list');
Route::get('edit-to-do-list/{id}', [App\Http\Controllers\ToDoListController::class, 'editToDoList'])->name('edit.to.do.list');
Route::post('update-to-do-list/{id}', [App\Http\Controllers\ToDoListController::class, 'updateToDoList'])->name('update.to.do.list');

Route::post('delete-image', [App\Http\Controllers\ToDoListController::class, 'deleteImage'])->name('delete.image');

Route::get('search', [App\Http\Controllers\ToDoListController::class, 'search'])->name('tags.search');
Route::get('get-tags', [App\Http\Controllers\ToDoListController::class, 'getTags']);

Route::post('search-to-do-list', [App\Http\Controllers\ToDoListController::class, 'searchToDoList'])->name('search.to.do.list');

Route::get('/home', [App\Http\Controllers\ToDoListController::class, 'getToDoList'])->name('home');
