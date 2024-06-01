<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\MonitoringController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//simpan data
//http://192.168.1.13:8000/api/api-get-data/?tdsValue=1000&suhu=25&jarakAir=10&phAir=7&jarakPakan=5
Route::get('/api-get-data', [DataController::class, 'store']);
Route::post('/api-get-data-post', [DataController::class, 'storePost']);

// Jam Pakan
//http://192.168.1.13:8000/api/api-jam-pakan
Route::get('/api-fish-feed', [DataController::class, 'index']);

Route::get('/api-send', function () {
    include_once(public_path('send.php'));
});

Route::get('/api-load-data', [DataController::class, 'loadData'])->name('load.data');
Route::get('/api-get-chart', [DataController::class, 'getRealtimeChart'])->name('chart.data');
Route::get('/api-get-realtime-data', [DataController::class, 'getRealtimeData']);
