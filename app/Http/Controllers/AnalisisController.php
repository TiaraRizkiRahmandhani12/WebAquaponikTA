<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasensor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AnalisisController extends Controller
{
    public function analisisView()
    {
        $twoWeeksAgo = Carbon::now()->subWeeks(2);

        // Ambil data dari 2 minggu terakhir
        $records = Datasensor::where('created_at', '>=', $twoWeeksAgo)->get();

        // Ambil data untuk 7 hari terakhir sebagai label
        $lastWeekRecords = Datasensor::where('created_at', '>=', Carbon::now()->subWeek())
            ->get(['created_at'])
            ->take(7);

        // Siapkan data untuk chart
        $labels = $lastWeekRecords->map(function ($record) {
            return $record->created_at->format('d M H:i');
        });

        $suhu = $records->pluck('suhu');
        $tdsValue = $records->pluck('tdsValue');
        $jarakAir = $records->pluck('jarakAir');
        $jarakPakan = $records->pluck('jarakPakan');
        $phAir = $records->pluck('phAir');
        $created_at = $records->pluck('created_at');

        return view('page.menu.analisis', compact('labels', 'suhu', 'tdsValue', 'jarakAir', 'jarakPakan', 'phAir', 'created_at'));
    }
}
