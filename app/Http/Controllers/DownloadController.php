<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datasensor;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

use PDF;
use Carbon\Carbon;

class DownloadController extends Controller
{
    public function downloadData($chartId)
    {
        // Tentukan kolom berdasarkan chartId
        $column = $this->getColumnName($chartId);

        // Hitung tanggal 2 minggu yang lalu
        $twoWeeksAgo = Carbon::now()->subMonth(1);

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

    public function downloadDataCSV($chartId)
    {
        // Tentukan kolom berdasarkan chartId
        $column = $this->getColumnName($chartId);

        // Hitung tanggal 2 minggu yang lalu
        $twoWeeksAgo = Carbon::now()->subMonth(1);

        // Fetch data based on the chartId untuk rentang waktu 2 minggu terakhir
        $records = Datasensor::select('created_at', $column)
            ->where('created_at', '>=', $twoWeeksAgo)
            ->orderBy('created_at', 'desc')
            ->distinct()
            ->get();

        // Store the data in the session
        session()->put('downloadData', $records);
        // Redirect to the download page
        return redirect()->route('download.csv.page', ['chartId' => $chartId]);
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



    public function DownloadCSV(Request $request)
    {
        // Mendapatkan data yang disimpan dalam session
        $records = session()->get('downloadData', []);

        // Mendapatkan chartId dari request
        $chartId = $request->input('chartId');

        // Mendefinisikan nama file CSV
        $fileName = 'download_' . $chartId . '_' . now()->format('Y-m-d_H-i-s') . '.csv';

        // Mendefinisikan header untuk response
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];

        // Mengembalikan response dengan data CSV
        return response()->streamDownload(function () use ($records, $chartId) {
            $output = fopen('php://output', 'w');

            // Header CSV
            fputcsv($output, ["Date", "Data"]);


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
                    case 'jarakpakanchart':
                        $data = $record->jarakPakan;
                        break;
                    default:
                        $data = '';
                        break;
                }

                // Validasi dan pembersihan data
                if (is_numeric($data)) {
                    $data = number_format($data, 2, '.', '');
                } else {
                    $data = str_replace(["\n", "\r", ","], [" ", " ", " "], $data);
                }

                // Logging untuk debugging
                Log::info("Date: $time, Data: $data");

                // Menambahkan baris baru ke dalam CSV
                fputcsv($output, [$time, $data]);
            }

            fclose($output);
        }, $fileName, $headers);
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

    public function downloadCsvTable(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan rentang waktu jika parameter ada
        if ($startDate && $endDate) {
            $latestdata = Datasensor::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Jika tidak ada parameter rentang waktu, ambil semua data
            $latestdata = Datasensor::orderBy('created_at', 'desc')->get();
        }

        // Header untuk file CSV
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=sensor_data.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Fungsi untuk menghasilkan konten CSV
        $callback = function () use ($latestdata) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array('No', 'Water Temperature', 'Ph', 'Fish Feed', 'TDS', 'Timestamp'));

            foreach ($latestdata as $index => $sensorData) {
                fputcsv($file, array(
                    $index + 1,
                    $sensorData->suhu,
                    $sensorData->phAir,
                    $sensorData->jarakPakan,
                    $sensorData->tdsValue,
                    $sensorData->created_at
                ));
            }
            fclose($file);
        };

        // Return response dengan menggunakan StreamedResponse
        return new StreamedResponse($callback, 200, $headers);
    }
}
