<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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


Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('checkcred', [AuthController::class, 'checkCredentials'])->name('checkcred'); 
Route::get('register', [AuthController::class, 'registration'])->name('register-page');
Route::post('register', [AuthController::class, 'register'])->name('register'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('settings', [AuthController::class, 'settings'])->name('settings')->middleware('admin');
Route::get('user/{id}', [AuthController::class, 'delete'])->name('delete')->middleware('admin');
Route::get('admin/{id}', [AuthController::class, 'makeAdmin'])->name('admin')->middleware('admin');

Route::resource('items', ItemController::class);