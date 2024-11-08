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
        $credential = $request->only('username', 'password');
        if (Auth::attempt($credential)) {
            $user = Auth::user();
            switch ($user->roles_id) {
                case '1':
                    // Logic for Admin
                    return redirect()->route('dashboard.admin'); // Return admin dashboard view
                case '2':
                    // Logic for Guru
                    return redirect()->route('dashboard.guru'); // Return guru dashboard view
                case '3':
                    // Logic for Walas
                    return redirect()->route('dashboard.walas'); // Return walas dashboard view
                default:
                    // If the role is not recognized, redirect or show an error
                    return redirect('login')->withErrors(['access_denied' => 'Akses ditolak.']);
            }
        }
        $siswa = SiswaModel::where('username', $request->username)->first();
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            // Simpan data siswa ke dalam session
            session(['siswa_id' => $siswa->id]);
            return redirect()->intended('siswa');
        } else
            // Jika login gagal, redirect kembali dengan input dan pesan error
            return redirect('login')->withInput()->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang sudah dimasukkan']);
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
