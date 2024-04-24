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



use App\Http\Controllers\PageController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
// Route::get('/', [LoginController::class, 'index'])->name('root');
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/analisis-view', [AnalisisController::class, 'index'])->name('analisis');

// Route::get('/control-view', [ControlController::class, 'index'])->name('control');
// Route::post('/pakan/update/{id}', [ControlController::class, 'updatePakan'])->name('pakan.update');
// Route::get('/send-pakan', [ControlController::class, 'sendPakan'])->name('send.pakan');

// Route::post('/save-sensor-data', [MonitoringController::class, 'saveSensorData']);

// Route::get('/device-view', [DeviceController::class, 'index'])->name('device');

// Route::get('/profile-view', [ProfileController::class, 'index'])->name('profile');
// Route::get('/profile-change-password', [ProfileController::class, 'changePassword'])->name('change.pswd');

// Route::post('/profile', [ProfileController::class, 'store'])->name('storeProfile');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [PageController::class, 'dashboardView'])->name('dashboard');
    Route::get('/analisis-view', [PageController::class, 'analisisView'])->name('analisis');
    Route::get('/device-view', [PageController::class, 'deviceView'])->name('device');
    Route::get('/profile-view', [PageController::class, 'profileView'])->name('profile');
    Route::get('/control-view', [PageController::class, 'controlView'])->name('control');
    Route::post('/pakan/update/{id}', [ControlController::class, 'updatePakan'])->name('pakan.update');

    Route::get('/profile-change-password', [UserController::class, 'changePassword'])->name('change.pswd');
});

Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/edit-data-user/{id}', [PageController::class, 'formEditUser'])->name('formEdit.user');
    Route::get('/form-add-user', [PageController::class, 'formAddUser'])->name('formAdd.user');
    Route::get('/list-user-view', [PageController::class, 'listUserView'])->name('list.user');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete.user');
    Route::post('/add-user', [UserController::class, 'store'])->name('add.user');
    Route::post('/update-user', [UserController::class, 'update'])->name('update.user');
    Route::post('/search-data-user', [UserController::class, 'search'])->name('search.user');
});


Route::get('/', [LoginController::class, 'index'])->name('root');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/send-pakan', [ControlController::class, 'sendPakan'])->name('send.pakan');
<<<<<<< HEAD
Route::get('/save-sensor-data', [MonitoringController::class, 'saveSensorData']);
=======
Route::post('/save-monitoring-data', [DashboardController::class, 'saveMonitoringData']);

Route::get('/device-view', [DeviceController::class, 'index'])->name('device');

Route::get('/profile-view', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile-change-password', [ProfileController::class, 'changePassword'])->name('change.pswd');

Route::post('/profile', [ProfileController::class, 'store'])->name('storeProfile');
>>>>>>> ff9e9ed07c44c11b76e60ea2977773d57899955c
