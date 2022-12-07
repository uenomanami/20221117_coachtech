<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\SessionController;


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

Route::get('/home', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'add'])->name('todo.add');
Route::post('/update', [TodoController::class, 'update'])->name('todo.update');
Route::post('/delete', [TodoController::class, 'delete'])->name('todo.delete');

Route::prefix('search')->group(function () {
  Route::get('', [TodoController::class, 'search']);
  Route::get('find', [TodoController::class,'find']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
