<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\InformationController;
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
use App\Http\Controllers\UserController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PasswordController;
use App\Models\Datasensor;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');
    Route::get('notif/{id}', [DashboardController::class, 'notif'])->name('notif');
    Route::get('/latest-monitoring-data', [DashboardController::class, 'getData'])->name('get.data');


    Route::get('/todolist/update-action/{item}', [ControlController::class, 'updateToDoList'])->name('control.updateToDoList');

    Route::get(
        '/control-vieww',
        [ControlController::class, 'controlView']
    )->name('control');

    Route::get('/analisis-view', [AnalisisController::class, 'analisisView'])->name('analisis');

    Route::get('/device-view', [DeviceController::class, 'deviceView'])->name('device');

    Route::get('/information-view', [InformationController::class, 'informationView'])->name('information');

    Route::get('/profile-view', [UserController::class, 'profileView'])->name('profile');

    Route::get('/change-password-view', [PasswordController::class, 'changePasswordView'])->name('change.pswd');
    Route::post('/change-password-process', [PasswordController::class, 'changePasswordProcess'])->name('change.pswd.process');

    Route::get('/control-view', [ControlController::class, 'controlView'])->name('control');

    Route::post('/pakan/update', [ControlController::class, 'updatePakan'])->name('pakan.update');

    Route::get('/download-pdf-view', [DownloadController::class, 'showDownloadPage'])->name('download.pdf.page');
    Route::get('/download/{chartId}', [DownloadController::class, 'downloadData'])->name('download.pdf');
    Route::get('/download-csv-view', [DownloadController::class, 'DownloadCSV'])->name('download.csv.page');
    Route::get('/download-csv-table', [DownloadController::class, 'downloadCsvTable'])->name('download.csv.table');
    Route::get('/download/csv/{chartId}', [DownloadController::class, 'downloadDataCSV'])->name('download.csv');

    Route::get('/schedule', [ControlController::class, 'schedule'])->name('schedule');
    Route::post('/schedule', [ControlController::class, 'schedule_update'])->name('schedule.update');

    Route::get('/notifications', [DashboardController::class, 'showNotifications'])->name('notifications');
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

Route::get('/lupapassword', [LoginController::class, 'lupa'])->name('lupa');
Route::post('/kirimkode', [LoginController::class, 'kirimkode'])->name('kirimkode');
Route::get('/reset', [LoginController::class, 'resetform'])->name('resetform');
Route::post('/reset', [LoginController::class, 'reset'])->name('reset');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');

Route::get('/send-pakan', [ControlController::class, 'sendPakan'])->name('send.pakan');
Route::get('/get-data', [ControlController::class, 'kedua']);

Route::get('/process', function () {
    include_once(public_path('send.php'));
});
