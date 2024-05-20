<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasensor;
use App\Exports\DownloadDataExport;
use Maatwebsite\Excel\Facades\Excel;


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

    public function showDownloadPage(Request $request)
    {
        // Mendapatkan data yang disimpan dalam session
        $records = session()->get('downloadData', []);

        // Mendapatkan chartId dari request
        $chartId = $request->input('chartId');

        // Mengambil nama kolom berdasarkan chartId
        $columnName = $this->getColumnName($chartId);

        // Mendapatkan waktu pembuatan dari data pertama (dianggap sama untuk semua data dalam rentang waktu)
        $createdAt = $records->first()->created_at;

        // Membuat nama file PDF
        $fileName = 'download_' . $chartId . '_' . now()->format('Y-m-d_H-i-s') . '.pdf';

        // Menggunakan library PDF untuk membuat dokumen PDF
        $pdf = PDF::loadView('page.download.pdf', compact('records', 'columnName', 'createdAt', 'chartId'));

        // Menghasilkan dan mengunduh PDF
        return $pdf->download($fileName);
    }

    private function getColumnName($chartId)
    {
        switch ($chartId) {
            case 'suhuchart':
                return 'suhu';
            case 'tdsValuechart':
                return 'tdsValue';
            case 'phchart':
                return 'phAir';
            case 'jarakairchart':
                return 'jarakAir';
            case 'jarakpakanchart':
                return 'jarakPakan';
            default:
                return '';
        }
    }

    public function k(Request $request)
    {
        // Mendapatkan data yang disimpan dalam session
        $records = session()->get('downloadData', []);

        // Mendapatkan chartId dari request
        $chartId = $request->input('chartId');

        // Mendapatkan nama kolom berdasarkan chartId
        $columnName = $this->getColumnName($chartId);

        // Mendefinisikan nama file CSV
        $fileName = 'download_' . $chartId . '_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Header CSV
        $csv = "Waktu,Data\n";


        // Mengisi data CSV
        foreach ($records as $record) {
            $time = $record->created_at->format('d M H:i');
            $data = '';

            switch ($chartId) {
                case 'suhuchart':
                    $data = $record->suhu;
                    break;
                case 'tdsValuechart':
                    $data = $record->tdsValue;
                    break;
                case 'phchart':
                    $data = $record->phAir;
                    break;
                case 'jarakairchart':
                    $data = $record->jarakAir;
                    break;
                default:
                    $data = $record->jarakPakan;;
                    break;
            }

            // Menambahkan baris baru ke dalam CSV
            $csv .= "$time,$data\n";

            // Periksa apakah $records berisi data yang diharapkan sebelum loop foreach

            // Loop foreach untuk menambahkan data ke dalam CSV


        }

        // Mendefinisikan header untuk response
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];


        // Mengembalikan response dengan data CSV
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);
    }

    public function downloadCsv(Request $request)
    {
        // Mendapatkan data yang disimpan dalam session
        $records = session()->get('downloadData', []);

        // Mendapatkan chartId dari request
        $chartId = $request->input('chartId');

        // Mendefinisikan nama file Excel
        $fileName = 'download_' . $chartId . '_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        // Menggunakan export class untuk membuat file Excel
        return Excel::download(new DownloadDataExport($records, $chartId), $fileName);
    }
}
