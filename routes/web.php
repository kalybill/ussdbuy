<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/',[AuthenticatedSessionController::class, 'create']);


Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [UserController::class,'index'])->name('dashboard');
    Route::post('/save-user', [UserController::class,'save'])->name('save_user');
    Route::post('/get_user', [UserController::class,'get_user']);
    Route::post('/dashboard', [UserController::class,'update_user'])->name('update_user');
    Route::post('/del_user', [UserController::class,'del_user']);
    Route::post('/black_white', [UserController::class,'black_white']);
});

require __DIR__.'/auth.php';
