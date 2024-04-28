<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function listUserView()
    {
        $users = User::all();

        return view('page.menu.data_user', ['users' => $users]);
    }

    public function formAddUser()
    {
        return view('page.admin.form_add');
    }

    public function store(Request $request)
    {
        // Validasi data input dengan pesan kesalahan yang ditentukan
        $validatedData = $request->validate(
            [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:8|',
                'verifikasi_password' => 'required|same:password',
                'status' => 'required|string|max:255',
                'no_hp' => ['required', 'string', 'max:255', 'regex:/^\+62\d+$/'], // Nomor telepon harus diawali dengan +62
                'alamat' => 'required|string',
                'foto' => 'required|image|max:2048', // Maksimum ukuran gambar 2MB
            ],
        );

        // Simpan foto
        $fotoPath = $request->file('foto')->store('public/foto');

        // Simpan data pengguna
        $user = new User;
        $user->username = $validatedData['username'];
        $user->password = bcrypt($validatedData['password']); // Pastikan untuk mengenkripsi password
        $user->status = $validatedData['status'];
        $user->no_hp = $validatedData['no_hp'];
        $user->alamat = $validatedData['alamat'];
        $user->foto = $fotoPath;
        $user->save();

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('list.user')->with('success', 'Profil berhasil disimpan.');
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus pengguna
        $user->delete();

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus.');
    }

    public function formEditUser($id)
    {
        $user = User::find($id);
        return view('page.admin.form_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Temukan pengguna yang ingin diperbarui berdasarkan ID
        $user = User::find($id);

        // Jika pengguna tidak ditemukan, kembalikan respons dengan pesan kesalahan
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validasi input dari formulir
        $request->validate([
            'username' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Perbarui data pengguna dengan data baru dari formulir
        $user->update([
            'username' => $request->username,
            'status' => $request->status,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            // Jika bidang foto perlu diperbarui, tambahkan logika untuk itu di sini
        ]);

        // Upload dan simpan foto jika diunggah
        if ($request->hasFile('foto')) {
            // Ambil file foto dari request
            $foto = $request->file('foto');
            // Generate nama unik untuk foto
            $namaFoto = uniqid() . '.' . $foto->getClientOriginalExtension();
            // Simpan foto ke penyimpanan
            $foto->storeAs('public/fotos', $namaFoto);
            // Update field foto pengguna dengan nama file yang baru
            $user->foto = 'fotos/' . $namaFoto;
            // Simpan perubahan
            $user->save();
        }

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('username', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('no_hp', 'like', '%' . $search . '%')
            ->orWhere('alamat', 'like', '%' . $search . '%')
            ->get();
        return view('page.menu.data_user', ['users' => $users]);
    }
}
