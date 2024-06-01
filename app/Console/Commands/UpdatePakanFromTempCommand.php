<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pakan;
use DB;

class UpdatePakanFromTempCommand extends Command
{
    protected $signature = 'pakan:update-from-temp';
    protected $description = 'Update data pakan from temp_pakans table to pakans table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tempPakans = DB::table('temp_pakans')->get();

        foreach ($tempPakans as $tempPakan) {
            $pakan = Pakan::findOrFail($tempPakan->pakan_id);
            $pakan->jam_pertama = $tempPakan->jam_pertama;
            $pakan->jam_kedua = $tempPakan->jam_kedua;
            $pakan->jam_ketiga = $tempPakan->jam_ketiga;
            $pakan->save();
        }



        $this->info('Data pakan berhasil diperbarui dari tabel sementara.');
    }
}
