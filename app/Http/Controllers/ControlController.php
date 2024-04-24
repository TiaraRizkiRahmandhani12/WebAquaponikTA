<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pakan;
use App\Models\Sensor;

class ControlController extends Controller
{
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
}
