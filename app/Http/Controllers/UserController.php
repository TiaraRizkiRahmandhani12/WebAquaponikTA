<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function profileView()
    {
        return view('page.profile.profile');
    }

    public function changePasswordView()
    {
        return view('page.profile.change_password');
    }

    public function changePasswordProcess(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Periksa apakah password saat ini sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        // Update password baru
        $user->password = bcrypt($request->password);
        $user->save(); // Simpan perubahan password

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
