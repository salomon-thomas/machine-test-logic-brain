<?php

use Illuminate\Support\Facades\Route;
//controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Livewire\BlogImport;
//livewire components
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\BlogList;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;

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

Route::middleware(['guest'])->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', BlogList::class)->name('blogs.index');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/users/create', CreateUser::class)->name('create-user');
});
Route::group(['prefix' => '/blogs', 'middleware' => ['auth', 'role:admin,editor,user']], function () {
    Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/import',BlogImport::class)->name('import_form');
    Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});
Route::group(['prefix' => '/blogs'], function () {
    Route::get('/{blog}', [BlogController::class, 'show'])->name('blogs.show');
});