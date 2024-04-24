<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
            return redirect()->route('login')->with('error', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }
}
