<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monitoring;

class AnalisisController extends Controller
{
    public function analisisView()
    {
        $now = now();
        $twoDaysAgo = $now->subDays(2);

        $records = Monitoring::where('created_at', '>=', $twoDaysAgo)
            ->whereRaw("HOUR(created_at) % 2 = 0") // Filter for every two hours
            ->orderBy('created_at', 'asc')
            ->get();

        // Prepare data for chart
        $labels = $records->map(function ($record) {
            return $record->created_at->format('d M H:i');
        });

        $temperatures = $records->pluck('temperature');
        $phLevels = $records->pluck('ph');
        $tdsLevels = $records->pluck('tds');
        $heights = $records->pluck('tinggi_air');

        return view('page.menu.analisis', compact('labels', 'temperatures', 'phLevels', 'tdsLevels', 'heights'));
    }
}
