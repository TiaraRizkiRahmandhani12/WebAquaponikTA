<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\control;
use App\Models\Datasensor;
use App\Models\Pakan;
use App\Models\User;
use App\Models\ToDoList;



class DashboardController extends Controller
{
    public function dashboardView()
    {
        $latestMonitoringData = Datasensor::latest('created_at')->first();
        $latestMonitoringDataAll = Datasensor::orderBy('created_at', 'desc')->distinct()->paginate(10);
        $latestPakanData = Pakan::latest('created_at')->first();
        $users = User::all();
        $Todolist = ToDoList::all();

        if ($latestPakanData) {
            // Format the timestamps to show only hour and minute
            $latestPakanData->jam_pertama = \Carbon\Carbon::parse($latestPakanData->jam_pertama)->format('H:i');
            $latestPakanData->jam_kedua = \Carbon\Carbon::parse($latestPakanData->jam_kedua)->format('H:i');
            $latestPakanData->jam_ketiga = \Carbon\Carbon::parse($latestPakanData->jam_ketiga)->format('H:i');
        }

        return view('page.menu.dashboard', [
            'data'  => $latestMonitoringData,
            'data2' => $latestMonitoringDataAll,
            'pakan' => $latestPakanData,
            'todolist' => $Todolist,
            'users' => $users
        ]);
    }

    public function dashboardData()
    {
        // Ambil data terbaru dari database
        $latestData = Datasensor::latest('created_at')->first();
        // Kemudian kirimkan data sebagai respons JSON
        return response()->json($latestData);
    }
}
