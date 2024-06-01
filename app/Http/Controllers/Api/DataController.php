<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pakan;
use Illuminate\Support\Facades\Validator;
use App\Models\Datasensor;
use Carbon\Carbon;

class DataController extends Controller
{
    public function index()
    {
        $dataJam = Pakan::select('jam_pertama', 'jam_kedua', 'jam_ketiga')->get();
        return response()->json(
            $dataJam
        );
    }

    public function loadData()
    {
        $latestData = Datasensor::latest('created_at')->first();
        return response()->json($latestData);
    }

    public function storePost(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'tdsValue' => 'required',
            'suhu' => 'required',
            'jarakAir' => 'required',
            'phAir' => 'required',
            'jarakPakan' => 'required',
        ]);

        // Ambil data dari permintaan POST
        $tdsValue = $request->input('tdsValue');
        $suhu = $request->input('suhu');
        $jarakAir = $request->input('jarakAir');
        $phAir = $request->input('phAir');
        $jarakPakan = $request->input('jarakPakan');


        // Lakukan sesuatu dengan data yang diterima dari Arduino
        // Misalnya, simpan ke dalam database atau lakukan operasi lainnya
        // Contoh:
        Datasensor::create([
            'tdsValue' => $tdsValue,
            'suhu' => $suhu,
            'jarakAir' => $jarakAir,
            'phAir' => $phAir,
            'jarakPakan' => $jarakPakan,

        ]);

        // Beri respons ke Arduino
        return response()->json(['message' => 'Data received successfully'], 200);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tdsValue' => 'required',
            'suhu' => 'required',
            'jarakAir' => 'required',
            'phAir' => 'required',
            'jarakPakan' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons dengan status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json(['message' => 'Gagal menyimpan data sensor', 'errors' => $validator->errors()], 422);
        }

        // Jika semua nilai yang diperlukan ada dalam request, simpan data ke dalam database
        $datasensor = Datasensor::create([
            'tdsValue' => $request->tdsValue,
            'suhu' => $request->suhu,
            'jarakAir' => $request->jarakAir,
            'phAir' => $request->phAir,
            'jarakPakan' => $request->jarakPakan
        ]);

        // Berikan respons berhasil dengan status 201 (Created)
        return response()->json(['message' => 'Data sensor berhasil disimpan', 'datasensor' => $datasensor], 200);
    }

    public function getRealtimeChart()
    {
        $threeWeeksAgo = Carbon::now()->subMonth(1);

        $latestData = [
            'suhu' => Datasensor::select('suhu as value', 'created_at')
                ->where('created_at', '>=', $threeWeeksAgo)
                ->orderBy('created_at', 'asc')
                ->get(),
            'tdsValue' => Datasensor::select('tdsValue as value', 'created_at')
                ->where('created_at', '>=', $threeWeeksAgo)
                ->orderBy('created_at', 'asc')
                ->get(),
            'jarakAir' => Datasensor::select('jarakAir as value', 'created_at')
                ->where('created_at', '>=', $threeWeeksAgo)
                ->orderBy('created_at', 'asc')
                ->get(),
            'jarakPakan' => Datasensor::select('jarakPakan as value', 'created_at')
                ->where('created_at', '>=', $threeWeeksAgo)
                ->orderBy('created_at', 'asc')
                ->get(),
            'phAir' => Datasensor::select('phAir as value', 'created_at')
                ->where('created_at', '>=', $threeWeeksAgo)
                ->orderBy('created_at', 'asc')
                ->get()
        ];

        return response()->json($latestData);
    }
}
