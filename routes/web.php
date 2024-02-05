<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LmaController;
use Illuminate\Http\Request;
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

Route::get('/', [LmaController::class, 'index'])->name('index');
Route::post('/login', [LmaController::class, 'login'])->name('login');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/logout', [LmaController::class, 'logout'])->name('logout');
    Route::get('/edit/{id}', [LmaController::class, 'show'])->name('edit-app');
    Route::post('/edit/save', [LmaController::class, 'store'])->name('save-app');
    
    Route::group(['middleware'=>'userType:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });
});
