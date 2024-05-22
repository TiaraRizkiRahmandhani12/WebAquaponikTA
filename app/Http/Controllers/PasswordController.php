<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;



class PasswordController extends Controller
{
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

    public function requestLink()
    {
        return view('page.forgot_password.request_link');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.']);
        }

        // Create a new token
        $token = Str::random(60);

        // Store or update the token and email in the password_resets table using Eloquent
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Create reset link
        $link = url('/reset/password/' . $token);

        // Send the email
        Mail::send('page.forgot_password.get_link', ['link' => $link, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your Password Reset Link');
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }


    public function formReserPassword($token)
    {
        return view(
            'page.forgot_password.reset_password',
            ['token' => $token]
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6', // Menambahkan aturan 'confirmed'
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid token.']);
        }

        // Check token expiration
        if (Carbon::parse($passwordReset->created_at)->addHours(24)->isPast()) {
            $passwordReset->delete();
            return back()->withErrors(['email' => 'Token has expired.']);
        }

        // Find user by email
        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Update user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete password reset token
        $passwordReset->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
    }
}
