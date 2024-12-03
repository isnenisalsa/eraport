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

        // Coba login sebagai user
        if (Auth::attempt($credential)) {
            $user = Auth::user();

            // Ambil role_id dari guru_roles
            $roleIds = $user->roles->pluck('id')->toArray();

            // Redirect berdasarkan role_id
            if (in_array(1, $roleIds)) {
                // Redirect ke dashboard admin
                return redirect()->route('dashboard.admin');
            } elseif (in_array(2, $roleIds)) {
                // Redirect ke dashboard guru
                return redirect()->route('dashboard.guru');
            } elseif (in_array(3, $roleIds)) {
                // Redirect ke dashboard walas
                return redirect()->route('dashboard.admin');
            } elseif (in_array(4, $roleIds)) {
                // Redirect ke dashboard walas
                return redirect()->route('dashboard.walas');
                // Redirect jika role tidak dikenali
                return redirect('login')->withErrors(['access_denied' => 'Akses ditolak.']);
            }
        }

        // Jika login gagal
        return redirect('login')->withErrors(['login_failed' => 'Username atau password salah.']);
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
