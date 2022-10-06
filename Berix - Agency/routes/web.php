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

Route::get('/index', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/author', [\App\Http\Controllers\HomeController::class, 'author'])->name('author');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/contact', [\App\Http\Controllers\AdminController::class, 'contact'])->name('contact');
Route::get('/show/{id}', [\App\Http\Controllers\HomeController::class, 'show'])->name('show');

Route::group(['middleware'=>['checkIsAuth', 'checkIsAdmin']], function(){
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    Route::get('/select/{table}', [\App\Http\Controllers\AdminController::class, 'select'])->name('select');
    Route::get('/select/{table}/{column}/{searchTerm}', [\App\Http\Controllers\AdminController::class, 'selectSearch'])->name('selectSearch');
    Route::delete('/delete/{table}/{id}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('delete');
});
