<?php

namespace App\Http\Controllers;

use App\Models\PembelajaranModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GuruModel;

use Illuminate\Http\Request;

class PembelajaranController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pembelajaran',
        ];

        $activeMenu = 'pembelajaran';

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        $pembelajaran = PembelajaranModel::with('mapel', 'kelas', 'guru')->get();

        // Mengambil data mapel, kelas, dan guru
        $mapel = MapelModel::all();
        $kelas = KelasModel::all();
        $guru = GuruModel::all();

        return view('admin.pembelajaran.index', [
            'breadcrumb' => $breadcrumb,
            'pembelajaran' => $pembelajaran,
            'mapel' => $mapel,  // Mengirim data mapel ke view
            'kelas' => $kelas,  // Mengirim data kelas ke view
            'guru' => $guru,    // Mengirim data guru ke view
            'activeMenu' => $activeMenu
        ]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'id_pembelajaran' => 'required', // Aturan validasi yang benar
            'mata_pelajaran' => 'required',
            'nama_kelas' => 'required',
            'nama_guru' => 'required', // Pastikan 'nama_guru' sesuai dengan kolom yang ada di tabel 'guru'
        ]);


        PembelajaranModel::create([
            'id_pembelajaran' => $request->id_pembelajaran,
            'mata_pelajaran' => $request->mata_pelajaran,
            'nama_kelas' => $request->nama_kelas,
            'nama_guru' => $request->nama_guru,
        ]);


        //ubah roles menjadi guru
        $guru = GuruModel::find($request->nama_guru);
        $guru->roles_id = '2';
        $guru->save();

        // Redirect setelah berhasil
        return redirect()->route('pembelajaran')->with('success', 'Data Pembelajaran berhasil disimpan');
    }
}