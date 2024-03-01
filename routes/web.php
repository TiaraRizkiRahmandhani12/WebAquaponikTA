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
use App\Http\Controllers\PakanController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/pakan', [PakanController::class, 'index'])->name('pakan');
Route::get('/apakek', [PakanController::class, 'apakek'])->name('apakek');
Route::get('/apakek2', [DashboardController::class, 'template'])->name('template');
