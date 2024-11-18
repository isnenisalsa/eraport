<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleIds = $user->roles->pluck('id')->toArray();

            // Redirect berdasarkan role_id
            if (in_array(1, $roleIds)) {
                $breadcrumb = (object) [
                    'title' => 'Daftar Siswa',
                ];
                $activeMenu = 'siswa';
                $siswa = SiswaModel::all();

                return view('walas.siswa.index', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
            } elseif (in_array(3, $roleIds)) {
                $breadcrumb = (object) [
                    'title' => 'Daftar Siswa',
                ];
                $activeMenu = 'siswa';
                $siswa = SiswaModel::all();

                return view('walas.siswa.index', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
            } else {
                return redirect('login')->withErrors(['access_denied' => 'Akses ditolak. Role Anda tidak dikenali.']);
            }
        } else {
            // Redirect to login page if not authenticated
            return redirect('login');
        }
    }
}
