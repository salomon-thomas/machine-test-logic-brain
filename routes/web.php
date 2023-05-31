<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => '/users', 'middleware' => ['auth']], function () {
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('create-user');
    Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('store-user');;
});
Route::group(['prefix' => '/blogs', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.index');
    Route::get('/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blogs.create');
    Route::post('/', [App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::get('/{blog}', [App\Http\Controllers\BlogController::class, 'show'])->name('blogs.show');
    Route::get('/{blog}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/{blog}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('/{blog}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
