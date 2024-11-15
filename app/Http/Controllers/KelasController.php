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
            'guru_nik' => 'required|exists:guru,nik', // Pastikan 'guru_nik' sesuai dengan kolom yang ada di tabel 'gurus'
        ]);

        KelasModel::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
        ]);
        $guru = GuruModel::find($request->guru_nik);
        $guru->roles_id = '3';
        $guru->save();

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
        $guru = GuruModel::find($request->guru_nik);
        $guru->roles_id = '3';
        $guru->save();
        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('kelas')->with('success', 'Data Kelas berhasil diperbarui');
    }
}
