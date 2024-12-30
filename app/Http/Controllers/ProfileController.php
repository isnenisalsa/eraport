<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    // Menampilkan profil pengguna
    public function show(Request $request)
    {


        $breadcrumb = (object) [
            'title' => 'Profil Pengguna',
        ];
        $activeMenu = 'profile';
        $user = Auth::user();
        $tab = $request->get('tab', 'profile'); // Default tab ke 'profile'

        // Menyesuaikan query profil berdasarkan tipe pengguna

        $profile = GuruModel::where('nik', $user->nik)->firstOrFail();


        return view('profil.index', compact('breadcrumb', 'activeMenu', 'user', 'profile', 'tab'));
    }

    public function showSiswa(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Profil Pengguna',
        ];
        $activeMenu = 'profile';
        $user = Auth::guard('siswa')->user();
        $tab = $request->get('tab', 'profile'); // Default tab ke 'profile'
        // Menyesuaikan query profil berdasarkan tipe pengguna
        $profile = SiswaModel::where('nis', $user->nis)->firstOrFail();
        return view('profil.siswa', compact('breadcrumb', 'activeMenu', 'user', 'profile', 'tab'));
    }

    // Menyimpan pembaruan profil pengguna
    public function updateProfile(Request $request, $nik)
    {
        // Validasi input
        $request->validate([
            'no_telp' => 'required|numeric|digits_between:12,13',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ], [
            'no_telp.numeric' => 'no telp harus berupa angka.',
            'no_telp.digits_between' => 'no telepon harus  12 sampai 13 angka',
            'nama.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong'
        ]);
        // Cari guru berdasarkan nik
        $profile = GuruModel::where('nik', $nik)->firstOrFail();

        // Perbarui data
        $profile->update([
            'no_telp' => $request->no_telp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profil guru berhasil diperbarui.');
    }

    public function updateAccount(Request $request, $nik)
    {

        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/', // Harus ada setidaknya satu huruf besar
                'regex:/[a-z]/', // Harus ada setidaknya satu huruf kecil
                'confirmed',
            ],
            'password_confirmation' => 'same:password',
            'email' => 'required|email',
        ], [
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar dan huruf kecil.',
            'password_confirmation.confirmed' => 'Password tidak cocok'
        ]);


        // Cari guru berdasarkan nik
        $profile = GuruModel::where('nik', $nik)->firstOrFail();

        // Perbarui data
        $profile->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('profile.show', ['tab' => 'edit-akun'])->with('success', 'Akun berhasil diperbarui.');
    }

    public function updateProfileSiswa(Request $request, $nis)
    {

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
        ]);

        // Cari siswa berdasarkan NIS
        $profileSiswa = SiswaModel::where('nis', $nis)->firstOrFail();

        // Perbarui data
        $profileSiswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('profile.show.siswa')->with('success', 'Profil Siswa berhasil diperbarui.');
    }

    public function updateAccountSiswa(Request $request, $nis)
    {

        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/', // Harus ada setidaknya satu huruf besar
                'regex:/[a-z]/', // Harus ada setidaknya satu huruf kecil
            ],
        ], [
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf besar dan huruf kecil.',
        ]);


        // Cari guru berdasarkan nis
        $profile = SiswaModel::where('nis', $nis)->firstOrFail();

        // Perbarui data
        $profile->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('profile.show.siswa', ['tab' => 'edit-akun'])->with('success', 'Akun berhasil diperbarui.');
    }
}
