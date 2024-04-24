<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monitoring;

class MonitoringController extends Controller
{
    public function saveSensorData(Request $request)
    {
        // Mendapatkan data dari permintaan
        $data = $request->all();

        // Menghitung status pompa dan pembuangan
        $status_pompa = $data['tinggi_air'] < 10 ? 0 : 1;
        $status_pembuangan = $data['tinggi_air'] < 10 ? 0 : 1;

        // Menyimpan data sensor ke dalam database
        $monitoring = Monitoring::create([
            'temperature' => $data['temperature'],
            'ph' => $data['ph'],
            'tds' => $data['tds'],
            'tinggi_air' => $data['tinggi_air'],
            'sisa_pakan' => $data['sisa_pakan'],
            'status_pompa' => $status_pompa,
            'status_pembuangan' => $status_pembuangan,
        ]);

        // Memeriksa apakah penyimpanan berhasil
        if ($monitoring) {
            return response()->json(['message' => 'Data sensor berhasil disimpan'], 200);
        } else {
            return response()->json(['message' => 'Gagal menyimpan data sensor'], 500);
        }
    }
}
