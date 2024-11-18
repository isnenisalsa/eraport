<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];


        $activeMenu = 'kelas';
        $kelas = KelasModel::with('guru', 'tahun_ajar')->get();
        $guru = GuruModel::all();
        $tahun = TahunAjarModel::all();
        return view('admin.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'guru' => $guru, 'tahun' => $tahun, 'activeMenu' => $activeMenu]);
    }



    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas', // Aturan validasi yang benar
            'nama_kelas' => 'required|string|max:255',
            'guru_nik' => 'required|exists:guru,nik', // Pastikan 'guru_nik' sesuai dengan kolom yang ada di tabel 'guru'
            'tahun_ajaran_id' => 'required',
        ]);

        // Buat entri baru di tabel kelas
        KelasModel::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
        ]);

        // Ambil guru berdasarkan guru_nik
        $guru = GuruModel::find($request->guru_nik);

        // Tambahkan role ke guru jika belum ada
        if (!$guru->roles()->where('role_id', 3)->exists()) {
            $guru->roles()->attach(3); // Menambahkan role dengan ID 3
        }

        return redirect()->route('kelas');
    }
    public function update(Request $request, $kode_kelas)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'nama_kelas' => 'required',
            'guru_nik' => 'required',
        ]);
        $kelas = KelasModel::findOrFail($kode_kelas);

        // Perbarui data guru dengan data dari form
        $kelas->update([
            'kode_kelas' => $request->input('kode_kelas'),
            'nama_kelas' => $request->input('nama_kelas'),
            'guru_nik' => $request->input('guru_nik'),
        ]);
        // $guru = GuruModel::find($request->guru_nik);
        // $guru->roles_id = '3';
        // $guru->save();
        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('kelas')->with('success', 'Data Kelas berhasil diperbarui');
    }
}
