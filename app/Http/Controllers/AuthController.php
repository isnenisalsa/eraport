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
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        // Autentikasi sebagai pengguna dengan role-based
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Ambil semua role user (asumsi relasi roles sudah ada)
            $roleIds = $user->roles->pluck('id')->toArray();

            // Redirect berdasarkan role
            if (in_array(1, $roleIds)) {
                return redirect()->route('dashboard');
            } elseif (in_array(2, $roleIds)) {
                return redirect()->route('dashboard');
            } elseif (in_array(3, $roleIds)) {
                return redirect()->route('dashboard');
            }

            // Jika role tidak dikenali
            return redirect('login')->withErrors(['access_denied' => 'Akses ditolak.']);
        }

        // Autentikasi sebagai siswa
        $siswa = SiswaModel::where('username', $request->username)->first();
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            // Gunakan guard 'siswa' jika middleware telah dikonfigurasi
            Auth::guard('siswa')->login($siswa);

            // Redirect ke dashboard siswa
            return redirect()->route('dashboard.siswa');
        }

        // Jika login gagal
        return redirect('login')->with(['login_failed' => 'Username atau password salah.']);
    
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
