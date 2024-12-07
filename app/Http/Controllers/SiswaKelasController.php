<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    public function index($kode_kelas)
    {

        $breadcrumb = (object) [
            'title' => 'Daftar Siswa',
        ];


        $activeMenu = 'Data Siswa';

        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->firstOrFail();
        $siswa_kelas = SiswaKelasModel::with('siswa', 'kelas')
            ->where('kelas_id', $kode_kelas)
            ->get();
        $kelas_id = KelasModel::where('kode_kelas', $kode_kelas)->value('kode_kelas');
        $tahunAjaranSekarang = KelasModel::where('kode_kelas', $kode_kelas)->value('tahun_ajaran_id');

        $siswa = SiswaModel::whereNotIn('nis', function ($query) use ($tahunAjaranSekarang) {
            $query->select('siswa_id')
                ->from('siswa_kelas')
                ->join('kelas', 'kelas.kode_kelas', '=', 'siswa_kelas.kelas_id')
                ->where('kelas.tahun_ajaran_id', $tahunAjaranSekarang); // Filter berdasarkan tahun ajaran
        })->get();

        return view('walas\siswa\index', [
            'breadcrumb' => $breadcrumb,
            'siswa_kelas' => $siswa_kelas,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'kelas_id' => $kelas_id,
            'activeMenu' => $activeMenu
        ]);
    }

    public function save(Request $request, $kode_kelas)
    {
        $request->validate([
            'siswa_id' =>  'required',

        ]);
        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->value('kode_kelas');

        SiswaKelasModel::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $kelas,
        ]);
        return redirect()->route('siswa_kelas', $kelas);
    }
}
