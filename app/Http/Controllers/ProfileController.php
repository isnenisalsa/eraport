<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    $profile = GuruModel::where('nik', $user->nik)->firstOrFail();

    return view('profil.index', compact('breadcrumb', 'activeMenu', 'user', 'profile'));
}

    // Menyimpan pembaruan profil pengguna
    public function updateProfile(Request $request, $nip)
    {
        
        // Validasi input
        $request->validate([
            'nip' => 'required|max:10',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string|max:255',
        ]);
    
        // Cari guru berdasarkan NIP
        $profile = GuruModel::where('nik', $nip)->firstOrFail();
    
        // Perbarui data
        $profile->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profil guru berhasil diperbarui.');
    }

    public function updateAccount(Request $request, $nip)
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
            'email' => 'required|email',
        ], [
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.', 
            'password.regex' => 'Password harus mengandung huruf besar dan huruf kecil.',
        ]);
        
    
        // Cari guru berdasarkan NIP
        $profile = GuruModel::where('nik', $nip)->firstOrFail();
    
        // Perbarui data
        $profile->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->route('profile.show', ['tab' => 'edit-akun'])->with('success', 'Akun berhasil diperbarui.');
    }
    
}
