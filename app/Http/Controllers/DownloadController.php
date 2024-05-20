<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasensor;
use Illuminate\Support\Facades\Session;
use PDF;
use Carbon\Carbon;

class DownloadController extends Controller
{


    public function downloadData($chartId)
    {
        // Tentukan kolom berdasarkan chartId
        $column = $this->getColumnName($chartId);

        // Hitung tanggal 2 minggu yang lalu
        $twoWeeksAgo = Carbon::now()->subWeeks(2);

        // Fetch data based on the chartId untuk rentang waktu 2 minggu terakhir
        $records = Datasensor::select('created_at', $column)
            ->where('created_at', '>=', $twoWeeksAgo)
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();

        // Store the data in the session
        session()->put('downloadData', $records);

        // Redirect to the download page
        return redirect()->route('download.pdf.page', ['chartId' => $chartId]);
    }


    // Method untuk mendapatkan nama kolom berdasarkan chartId
    private function getColumnName($chartId)
    {
        switch ($chartId) {
            case 'suhuchart':
                return 'suhu';
            case 'tdsValuechart':
                return 'tdsValue';
            case 'phchart':
                return 'phAir';
                // Tambahkan case untuk chart lainnya jika diperlukan
            default:
                return ''; // Atur default jika tidak ada chartId yang cocok
        }
    }

    public function showDownloadPage(Request $request)
    {
        // Mendapatkan data yang disimpan dalam session
        $records = session()->get('downloadData', []);

        // Mendapatkan chartId dari request
        $chartId = $request->input('chartId');

        // Return view dengan data dan chartId
        return view('page.download.pdf', compact('records', 'chartId'));
    }
}
