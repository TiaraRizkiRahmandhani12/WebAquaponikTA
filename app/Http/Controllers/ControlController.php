<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pakan;
use App\Models\ToDoList;
use App\Models\Datasensor;
use App\Models\DrainageSchedule;
use App\Models\TempPakan;


class ControlController extends Controller
{
    // public function controlView()
    // {
    //     $pakan = Pakan::findOrFail(1);
    //     return view('page.menu.control', compact('pakan'));
    // }

    public function schedule()
    {
        $schedule = DrainageSchedule::first();
        $todolist = ToDoList::all();
        $pakan = TempPakan::first();

        return view('page.menu.managemen', compact('schedule', 'todolist', 'pakan'));
    }

    public function schedule_update(Request $request)
    {
        DrainageSchedule::where('id', 1)->update([
            'every' => $request->every
        ]);
        return redirect()->back()->with('success', 'Data berhasil di update');
    }

    public function updateToDoList($item)
    {
        $item = ToDoList::findOrFail($item);
        $item->action = 'Pending';
        $item->status = 'Menunggu Proses Normalisasi';
        $item->save();

        return redirect()->back()->with('success', 'Action updated to Pending');
    }

    public function updatePakan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jam_pertama' => 'required|different:jam_kedua',
            'jam_kedua' => 'required|different:jam_pertama',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data pakan. Jam tidak boleh sama.');
        }

        // Simpan data ke tabel sementara
        $jamKetiga = $request->input('jam_ketiga', $request->input('jam_kedua')); // Set nilai default untuk jam_ketiga
        \DB::table('temp_pakans')->updateOrInsert(
            ['id' => 1], // Asumsi hanya ada satu entri dengan id 1
            [
                'jam_pertama' => $request->jam_pertama,
                'jam_kedua' => $request->jam_kedua,
                'jam_ketiga' => $jamKetiga,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Redirect kembali dengan pesan sukses dan data pakan
        return redirect()->back()
            ->with(
                'success',
                'Data pakan berhasil disimpan dan akan diperbarui pada jam 1 malam.'
            );
    }

    public function sendPakan()
    {
        $dataJam = Pakan::select('jam_pertama', 'jam_kedua', 'jam_ketiga')->get();
        return response()->json($dataJam);
    }

    public function kedua(Request $request)
    {
        if ($request->has(['tdsValue', 'suhu', 'jarakAir', 'phAir', 'jarakPakan'])) {
            $var1 = $request->tdsValue;
            $var2 = $request->suhu;
            $var3 = $request->jarakAir;
            $var4 = $request->phAir;
            $var5 = $request->jarakPakan;
            $data = Datasensor::create([
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
