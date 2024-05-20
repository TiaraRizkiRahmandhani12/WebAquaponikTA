<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pakan;
use App\Models\monitoring;
use App\Models\Datasensor;
use DB;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;

class ControlController extends Controller
{
    public function controlView()
    {
        $pakan = Pakan::findOrFail(1);
        return view('page.menu.control', compact('pakan'));
    }

    // public function updatePakan(Request $request, $id)
    // {
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'jam_pertama' => 'required|different:jam_kedua,jam_ketiga',
    //         'jam_kedua' => 'required|different:jam_pertama,jam_ketiga',
    //         'jam_ketiga' => 'required|different:jam_pertama,jam_kedua',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput()
    //             ->with('error', 'Gagal memperbarui data pakan. jam tidak boleh sama.');
    //     }


    //     // Ambil data pakan yang akan diupdate
    //     $pakan = Pakan::findOrFail($id);

    //     // Update data pakan
    //     $pakan->jam_pertama = $request->jam_pertama;
    //     $pakan->jam_kedua = $request->jam_kedua;
    //     $pakan->jam_ketiga = $request->jam_ketiga;
    //     $pakan->save();

    //     return redirect()->back()->with('success', 'Data pakan berhasil diperbarui');
    // }

    public function updatePakan(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'jam_pertama' => 'required|different:jam_kedua,jam_ketiga',
            'jam_kedua' => 'required|different:jam_pertama,jam_ketiga',
            'jam_ketiga' => 'required|different:jam_pertama,jam_kedua',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data pakan. jam tidak boleh sama.');
        }

        // Simpan data ke tabel sementara
        \DB::table('temp_pakans')->updateOrInsert(
            ['pakan_id' => $id],
            [
                'jam_pertama' => $request->jam_pertama,
                'jam_kedua' => $request->jam_kedua,
                'jam_ketiga' => $request->jam_ketiga,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Data pakan berhasil disimpan dan akan diperbarui pada jam 1 malam.');
    }

    public function sendPakan()
    {
        $dataJam = Pakan::select('jam_pertama', 'jam_kedua', 'jam_ketiga')->get();
        return response()->json($dataJam);
    }

    // public function saveSensorData(Request $request)
    // {
    //     // Mendapatkan data dari permintaan
    //     $data = $request->all();

    //     // Menghitung status pompa dan pembuangan
    //     $status_pompa = $data['tinggi_air'] < 10 ? 0 : 1;
    //     $status_pembuangan = $data['tinggi_air'] < 10 ? 0 : 1;

    //     // Menyimpan data sensor ke dalam database
    //     $monitoring = Datasensor::create([
    //         'temperature' => $data['temperature'],
    //         'ph' => $data['ph'],
    //         'tds' => $data['tds'],
    //         'tinggi_air' => $data['tinggi_air'],
    //         'sisa_pakan' => $data['sisa_pakan'],
    //         'status_pompa' => $status_pompa,
    //         'status_pembuangan' => $status_pembuangan,
    //     ]);

    //     // Memeriksa apakah penyimpanan berhasil
    //     if ($monitoring) {
    //         return response()->json(['message' => 'Data sensor berhasil disimpan'], 200);
    //     } else {
    //         return response()->json(['message' => 'Gagal menyimpan data sensor'], 500);
    //     }
    // }

    // public function saveSensorData(Request $request)
    // {
    //     $token = env('TELEGRAM_BOT_TOKEN');
    //     // Mendapatkan data dari permintaan
    //     $data = $request->all();

    //     // Menghitung status pompa dan pembuangan
    //     $status_pompa = $data['tinggi_air'] < 10 ? 0 : 1;
    //     $status_pembuangan = $data['tinggi_air'] < 10 ? 0 : 1;

    //     // Menyimpan data sensor ke dalam database
    //     $monitoring = Monitoring::create([
    //         'temperature' => $data['temperature'],
    //         'ph' => $data['ph'],
    //         'tds' => $data['tds'],
    //         'tinggi_air' => $data['tinggi_air'],
    //         'sisa_pakan' => $data['sisa_pakan'],
    //         'status_pompa' => $status_pompa,
    //         'status_pembuangan' => $status_pembuangan,
    //     ]);

    //     // Mengecek kondisi dan mengirim notifikasi jika diperlukan
    //     if ($monitoring) {
    //         if (
    //             $monitoring->temperature < 25 || $monitoring->temperature > 30 || $monitoring->ph < 6 || $monitoring->ph > 7 || $monitoring->tds < 72 || $monitoring->tds > 100
    //         ) {
    //             Notification::send($monitoring, new TelegramNotification());
    //         }
    //         return response()->json(['message' => 'Data sensor berhasil disimpan'], 200);
    //     } else {
    //         return response()->json(
    //             ['message' => 'Gagal menyimpan data sensor'],
    //             500
    //         );
    //     }
    // }

    // public function store(Request $request)
    // {
    //     if ($request->has(['tdsValue', 'suhu', 'jarakAir', 'phAir', 'jarakPakan'])) {
    //         $var1 = $request->tdsValue;
    //         $var2 = $request->suhu;
    //         $var3 = $request->jarakAir;
    //         $var4 = $request->phAir;
    //         $var5 = $request->jarakPakan;

    //         Monitoring::create([
    //             'tds' => $var1,
    //             'temperature' => $var2,
    //             'tinggi_air' => $var3,
    //             'ph' => $var4,
    //             'sisa_pakan' => $var5
    //         ]);

    //         return response()->json(['message' => 'Data sensor berhasil disimpan'], 200);
    //     } else {
    //         return response()->json(
    //             ['message' => 'Gagal menyimpan data sensor'],
    //             500
    //         );
    //     }
    // }

    public function kedua(Request $request)
    {
        if ($request->has(['tdsValue', 'suhu', 'jarakAir', 'phAir', 'jarakPakan'])) {
            $var1 = $request->tdsValue;
            $var2 = $request->suhu;
            $var3 = $request->jarakAir;
            $var4 = $request->phAir;
            $var5 = $request->jarakPakan;
            Datasensor::create([
                'tdsValue' => $var1,
                'suhu' => $var2,
                'jarakAir' => $var3,
                'phAir' => $var4,
                'jarakPakan' => $var5
            ]);

            return response()->json(['message' => 'Data sensor berhasil disimpan'], 200);
        } else {
            return response()->json(
                ['message' => 'Gagal menyimpan data sensor'],
                500
            );
        }
    }
}
