<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Datasensor;
use App\Models\ToDoList;
use App\Models\User;

class ProcessToDolist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todolist:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process threshold and add items to ToDoList';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Hapus data ToDoList yang lebih lama dari 3 jam
        ToDoList::where('created_at', '<', now()->subHour(3))->delete();

        // Ambil data terbaru dari tabel datasensors
        $latestSensorData = Datasensor::latest()->first();

        // Periksa apakah data sensor terbaru ada dan ekstrak nilai yang relevan
        if ($latestSensorData) {
            $ph = $latestSensorData->phAir;
            $tds = $latestSensorData->tdsValue;
            $suhu = $latestSensorData->suhu;
            $jarakPakan = $latestSensorData->jarakPakan;
            $jarakAir = $latestSensorData->jarakAir;

            // Definisikan item untuk diperiksa dan rentang normalnya
            $items = [
                'ph' => $ph,
                'tds' => $tds,
                'suhu' => $suhu,
                'jarak pakan' => $jarakPakan,
                'jarak air' => $jarakAir
            ];

            $conditions = [
                'ph' => fn ($value) => $value < 5 || $value > 9,
                'tds' => fn ($value) => $value > 1000,
                'suhu' => fn ($value) => $value < 25 || $value > 40,
                'jarak pakan' => fn ($value) => $value < 10,
                'jarak air' => fn ($value) => $value < 10,
            ];

            foreach ($items as $item => $value) {
                $isConditionMet = $conditions[$item]($value);

                // Cek apakah item sudah ada dalam ToDoList dalam 3 jam terakhir
                $existingItem = ToDoList::where('item', $item)
                    ->where('created_at', '>=', now()->subHour(10))
                    ->first();

                if ($isConditionMet) {
                    // Jika kondisi item tidak normal
                    if ($existingItem) {
                        // Jika item sudah ada, perbarui timestamp
                        $existingItem->touch();
                    } else {
                        // Jika item tidak ada, tambahkan ke ToDoList
                        $newItem = ToDoList::create([
                            'item' => $item,
                            'status' => 'Not Completed',
                            'action' => 'Submit',
                            'created_at' => now()
                        ]);

                        // Kirim pesan WhatsApp
                        // if ($newItem) {
                        //     // Ambil data pengguna untuk nomor telepon
                        //     $users = User::get();
                        //     foreach ($users as $user) {
                        //         if ($user->no_hp) {
                        //             // Buat pesan WhatsApp sesuai dengan item
                        //             $message = "*Warning!* $item berada di luar batas normal.\n$item: $value";
                        //             // Kirim pesan WhatsApp
                        //             $this->kirimpesan($message, $user->no_hp);
                        //         }
                        //     }
                        // }
                    }
                } else {
                    // Jika kondisi item sudah kembali normal
                    if ($existingItem) {
                        // Hapus item dari ToDoList
                        $existingItem->delete();
                    }
                }
            }
        }
    }

    public function fixPhoneNumber($number)
    {
        // Menghapus karakter "-" dari nomor telepon
        $number = str_replace('-', '', $number);

        // Jika nomor telepon dimulai dengan "0", ganti dengan "62"
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Jika nomor telepon dimulai dengan "+62", hilangkan tanda "+"
        if (substr($number, 0, 3) === '+62') {
            $number = '62' . substr($number, 3);
        }

        return $number;
    }

    public function kirimpesan($message, $notelp)
    {
        $data = [
            'phone_number' => $this->fixPhoneNumber($notelp),
            'device_id' => 'wapro2',
            'message_type' => 'text',
            'message' => $message,
        ];
        $json_data = json_encode($data);

        // Inisialisasi cURL
        $ch = curl_init();

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_URL, 'https://api.kirimwa.id/v1/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . 'nGWs9oOE2qWwjitK60sflt3vx1WTNqShLSF23GB5UEO3cZFdWKwsh7MHt4x5nFPj-catur'
        ));

        // Jalankan request
        $response = curl_exec($ch);
        //print_r($response);

        // Cek apakah request berhasil atau tidak
        if ($response === false) {
            return false;
        } else {
            return true;
        }

        // Tutup koneksi cURL
        curl_close($ch);
        return;
    }
}
