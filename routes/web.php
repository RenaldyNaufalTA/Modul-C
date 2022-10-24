<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [LoginController::class, 'login_view']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login_view'])->name('login.view');
    Route::post('/login/auth', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'register_view'])->name('register.view');
    Route::post('/register/store', [RegisterController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('buy');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::post('/logout', [LoginController::class, 'logout']);
});