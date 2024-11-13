<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];


        $activeMenu = 'kelas';
        $kelas = KelasModel::with('guru')->get();
     $guru = GuruModel::all();
        return view('admin.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }

    

public function save(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas', // Aturan validasi yang benar
            'nama_kelas' => 'required|string|max:255',
            'guru_nik' => 'required', // Pastikan 'guru_nik' sesuai dengan kolom yang ada di tabel 'gurus'
        ]);
    
        KelasModel::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
        ]);
        return redirect()->route('kelas'); 
    }
}