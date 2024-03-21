<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pakan;
use App\Models\Sensor;
use App\Models\SwitchPakan;

class ControlController extends Controller
{
    public function index()
    {
        $pakan = Pakan::findOrFail(1);
        $switchPakanData = SwitchPakan::pluck('nilai', 'jam')->toArray();
        return view('page.monitoring.control', compact('pakan', 'switchPakanData'));
    }


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


        // Ambil data pakan yang akan diupdate
        $pakan = Pakan::findOrFail($id);

        // Update data pakan
        $pakan->jam_pertama = $request->jam_pertama;
        $pakan->jam_kedua = $request->jam_kedua;
        $pakan->jam_ketiga = $request->jam_ketiga;
        $pakan->save();

        return redirect()->back()->with('success', 'Data pakan berhasil diperbarui');
    }

    public function sendPakan()
    {
        $dataJam = Pakan::select('jam_pertama', 'jam_kedua', 'jam_ketiga')->get();
        return response()->json($dataJam);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'suhu' => 'required|numeric',
    //     ]);

    //     $temperature = new Sensor();
    //     $temperature->suhu = $request->suhu;
    //     $temperature->save();

    //     return response()->json(['message' => 'Data suhu disimpan'], 201);
    // }

    public function switch_pakan(Request $request)
    {
        // Loop through each field and update or create data in the database
        for ($i = 1; $i <= 14; $i++) {
            // Access the value of each field using request
            $value = $request->input('field_' . $i, 0); // Default to 0 if not present

            // Find the existing record by 'jam' value
            $switchPakan = SwitchPakan::where('jam', $i)->first();

            // If the record exists, update it; otherwise, create a new one
            if ($switchPakan) {
                $switchPakan->update(['nilai' => $value]);
            } else {
                SwitchPakan::create([
                    'jam' => $i,
                    'nilai' => $value,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function send_pakan_switch()
    {
        // Ambil data dari model SwitchPakan
        $data = SwitchPakan::pluck('nilai', 'jam')->toArray();

        // Format data ke dalam JSON dan kirimkan sebagai respons
        return response()->json($data);
    }
}
