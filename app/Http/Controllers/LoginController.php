<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('page.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('root')->with('error', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('root')->with('success', 'Kamu berhasil logout');
    }
    public function lupa()
    {
        return view('page.forgot_password.request_link');
    }
    public function kirimkode(Request $request)
    {

        // Generate a 6-digit random token
        $randomtoken = rand(100000, 999999);

        // Find the user by email
        $user = User::where('username', $request->username)->first();

        if ($user) {
            if ($user->no_hp != null) {
                // Update the user's token
                if ($this->kirimpesan('token untuk mengganti password anda : ' . $randomtoken, $user->no_hp)) {

                    $user->update([
                        'token' => $randomtoken
                    ]);
                } else {
                    return redirect()->back()->with('error', 'terjadi error saat mengirim pesan wa, pastkan nomer anda terdaftar whatsapp');
                }
            } else {
                return redirect()->back()->with('error', 'No wa Tidak ada');
            }
        } else {
            return redirect()->back()->with('error', 'Username Tidak ditemukan');
        }

        // Redirect to the reset password view
        return redirect()->route('resetform');
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
    public function kirimpesan($pesan, $notelp)
    {
        $data = [
            'phone_number' => $this->fixPhoneNumber($notelp),
            'device_id' => 'wapro2',
            'message_type' => 'text',
            'message' => $pesan,
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
    public function resetform()
    {
        return view('page.forgot_password.reset_password');
    }
    public function reset(Request $request)
    {
        $cektoken = User::where('token', $request->token)->first();
        if ($cektoken) {
            if ($request->password == $request->password_confirmation) {
                $cektoken->update([
                    'password' => Hash::make($request->password),
                    'token' => null
                ]);
            } else {
                return redirect()->back()->with('error', 'Password konfirmasi tidak sama');
            }
        } else {
            return redirect()->back()->with('error', 'Token salah');
        }
        return redirect()->route('login');
    }
}
