<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\control;
use App\Models\monitoring;
use App\Models\Pakan;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $latestMonitoringData = Monitoring::latest('created_at')->first();
        $latestPakanData = Pakan::latest('created_at')->first();

        return view('page.menu.dashboard', [
            'data'  => $latestMonitoringData,
            'pakan' => $latestPakanData,
        ]);
    }
}
