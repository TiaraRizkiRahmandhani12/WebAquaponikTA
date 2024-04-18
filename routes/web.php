<?php

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



use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('root');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/analisis-view', [AnalisisController::class, 'index'])->name('analisis');

Route::get('/control-view', [ControlController::class, 'index'])->name('control');
Route::post('/pakan/update/{id}', [ControlController::class, 'updatePakan'])->name('pakan.update');
Route::get('/send-pakan', [ControlController::class, 'sendPakan'])->name('send.pakan');

Route::get('/device-view', [DeviceController::class, 'index'])->name('device');

Route::get('/profile-view', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile-change-password', [ProfileController::class, 'changePassword'])->name('change.pswd');

Route::post('/profile', [ProfileController::class, 'store'])->name('storeProfile');
