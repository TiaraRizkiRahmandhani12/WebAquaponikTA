<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalisisController;
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

use App\Http\Controllers\ControlController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PasswordController;
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

    Route::get('/dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');
    Route::get('/latest-monitoring-data', [DashboardController::class, 'getData'])->name('get.data');

    Route::get('/analisis-view', [AnalisisController::class, 'analisisView'])->name('analisis');

    Route::get('/device-view', [DeviceController::class, 'deviceView'])->name('device');

    Route::get('/profile-view', [UserController::class, 'profileView'])->name('profile');

    Route::get('/change-password-view', [PasswordController::class, 'changePasswordView'])->name('change.pswd');
    Route::post('/change-password-process', [PasswordController::class, 'changePasswordProcess'])->name('change.pswd.process');

    Route::get('/control-view', [ControlController::class, 'controlView'])->name('control');


    Route::post('/pakan/update/{id}', [ControlController::class, 'updatePakan'])->name('pakan.update');

    Route::get('/download-pdf-view', [DownloadController::class, 'showDownloadPage'])->name('download.pdf.page');
    Route::get('/download/{chartId}', [DownloadController::class, 'downloadData'])->name('download.pdf');
    Route::get('/download-csv-view', [DownloadController::class, 'DownloadCSV'])->name('download.csv.page');
    Route::get('/download/csv/{chartId}', [DownloadController::class, 'downloadDataCSV'])->name('download.csv');
});

Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/edit-data-user/{id}', [AdminController::class, 'formEditUser'])->name('formEdit.user');
    Route::post('/update-user', [AdminController::class, 'update'])->name('update.user');
    Route::get('/form-add-user', [AdminController::class, 'formAddUser'])->name('formAdd.user');
    Route::get('/list-user-view', [AdminController::class, 'listUserView'])->name('list.user');
    Route::delete('/delete-user/{id}', [AdminController::class, 'destroy'])->name('delete.user');
    Route::post('/add-user', [AdminController::class, 'store'])->name('add.user');
    Route::post('/search-data-user', [AdminController::class, 'search'])->name('search.user');
});

Route::get('/', [LoginController::class, 'index'])->name('root');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');

Route::get('/send-pakan', [ControlController::class, 'sendPakan'])->name('send.pakan');
Route::get('/save-sensor-data', [ControlController::class, 'saveSensorData']);
Route::get('/store-data', [ControlController::class, 'store']);
Route::get('/kedua', [ControlController::class, 'kedua']);

Route::get('/request-link-forgot-password', [PasswordController::class, 'requestLink'])->name('request.link');
Route::post('/send-link', [PasswordController::class, 'sendResetLinkEmail'])->name('send.link');
Route::get('/reset/password/{token}', [PasswordController::class, 'formResetPassword'])->name('reset.pswd');
Route::post('/reset/password', [PasswordController::class, 'resetPassword']);
