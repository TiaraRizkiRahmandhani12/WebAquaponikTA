<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\control;
use App\Models\monitoring;
use App\Models\Pakan;

class DashboardController extends Controller
{
    public function index()
    {
        $latestMonitoringData = Monitoring::latest('created_at')->first();
        $latestPakanData = Pakan::latest('created_at')->first();

        return view('page.monitoring.dashboard', [
            'data'  => $latestMonitoringData,
            'pakan' => $latestPakanData,
        ]);
    }

    public function saveMonitoringData(Request $request)
    {
        // Memvalidasi input
        $validatedData = $request->validate([
            'tds' => 'required|numeric',
            'temperature' => 'required|numeric',
            'tinggi_air' => 'required|numeric',
            'ph' => 'required|numeric',
            'sisa_pakan' => 'required|numeric',
        ]);

        // Menyimpan data monitoring ke dalam database
        $monitoring = new Monitoring();
        $monitoring->tds = $request->tds;
        $monitoring->temperature = $request->temperature;
        $monitoring->tinggi_air = $request->tinggi_air;
        $monitoring->ph = $request->ph;
        $monitoring->sisa_pakan = $request->sisa_pakan;
        $monitoring->save();

        return response()->json(['success' => 'Data monitoring berhasil disimpan'], 200);
    }
}
