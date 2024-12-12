<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\Models\GuruModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Menampilkan profil pengguna
    public function show()
    {
        $breadcrumb = (object) [
            'title' => 'Profil Pengguna',
        ];
        $activeMenu = 'profile';
        $user = Auth::user();

        return view('profil.index', compact('breadcrumb', 'activeMenu', 'user'));
    }

    // Menyimpan pembaruan profil pengguna
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,'. Auth::id(),
            'password' => 'nullable|confirmed',
        ]);

        // Ambil ID guru dari request
        $nik = $request->input('nik');

        // Temukan data guru berdasarkan ID
        $guru = GuruModel::findOrFail($nik);

        // Update data guru
        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password jika ada perubahan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profil guru berhasil diperbarui.');
    }
}
