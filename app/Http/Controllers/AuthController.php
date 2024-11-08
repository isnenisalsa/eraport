<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {

        return view('login');
    }
    public function proses_login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    // Ambil input untuk autentikasi
    $credential = $request->only('username', 'password');

    // Coba login sebagai user (admin, guru, atau walas)
    if (Auth::attempt($credential)) {
        $user = Auth::user();
        switch ($user->roles_id) {
            case '1':
                // Redirect ke dashboard admin
                return redirect()->route('dashboard.admin');
            case '2':
                // Redirect ke dashboard guru
                return redirect()->route('dashboard.guru');
            case '3':
                // Redirect ke dashboard walas
                return redirect()->route('dashboard.walas');
            default:
                // Redirect jika role tidak dikenali
                return redirect('login')->withErrors(['access_denied' => 'Akses ditolak.']);
        }
    }

    // Jika user tidak ditemukan, cek di tabel siswa
    $siswa = SiswaModel::where('username', $request->username)->first();
    if ($siswa && Hash::check($request->password, $siswa->password)) {
        // Simpan data siswa ke dalam session
        session(['siswa_id' => $siswa->id]);
        return redirect()->intended('siswa'); // Redirect ke halaman siswa
    } else {
        // Jika login gagal, redirect kembali dengan pesan error
        return redirect('login')->withInput()->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang sudah dimasukkan']);
    }
}
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
    public function logout_siswa(Request $request)
    {
        // Hapus data siswa dari session
        session()->forget('id');
        // Logout pengguna (jika diperlukan)
        Auth::logout();
        // Redirect ke halaman login
        return redirect('login');
    }
}
