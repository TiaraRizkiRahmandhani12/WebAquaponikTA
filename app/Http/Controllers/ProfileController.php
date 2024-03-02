<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('page.profile.profile');
    }

    public function changePassword()
    {
        return view('page.profile.change_password');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        // Simpan data ke dalam database
        $userData = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        $data = User::create($userData);

        if ($data) {
            return redirect()->route('profile')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }
}
