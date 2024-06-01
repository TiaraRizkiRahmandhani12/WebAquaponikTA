<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasensor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AnalisisController extends Controller
{
    public function analisisView(Request $request)
    {
        // Ambil parameter start_date dan end_date dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika tidak ada parameter rentang waktu, gunakan rentang waktu default (2 minggu terakhir)
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->subWeeks(2)->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');
        }

        // Ambil data berdasarkan rentang waktu
        $latestdata = Datasensor::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->paginate(10);

        // Ambil data untuk 7 hari terakhir sebagai label
        $lastWeekRecords = Datasensor::where('created_at', '>=', Carbon::now()->subWeek())
            ->get(['created_at'])
            ->take(7);

        // Siapkan data untuk chart
        $labels = $lastWeekRecords->map(function ($record) {
            return $record->created_at->format('d M H:i');
        });

        $suhu = $latestdata->pluck('suhu');
        $tdsValue = $latestdata->pluck('tdsValue');
        $jarakAir = $latestdata->pluck('jarakAir');
        $jarakPakan = $latestdata->pluck('jarakPakan');
        $phAir = $latestdata->pluck('phAir');
        $created_at = $latestdata->pluck('created_at');

        return view('page.menu.analisis', compact('labels', 'suhu', 'tdsValue', 'jarakAir', 'jarakPakan', 'phAir', 'created_at', 'latestdata', 'startDate', 'endDate'));
    }
}
