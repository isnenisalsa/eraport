<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    public function index($kode_kelas)
    { {

            $breadcrumb = (object) [
                'title' => 'Daftar Siswa',
            ];


            $activeMenu = 'Data Siswa';

            // Ambil data kelas berdasarkan kode_kelas
            $kelas = KelasModel::where('kode_kelas', $kode_kelas)->firstOrFail();
            $kelas = KelasModel::all();  // Memastikan data kelas berhasil diambil
            $siswa_kelas = SiswaKelasModel::with('siswa', 'kelas')
                ->where('kelas_id', $kode_kelas)
                ->get();
            $kelas_id = KelasModel::where('kode_kelas', $kode_kelas)->value('kode_kelas');

            // Ambil semua siswa yang BELUM terdaftar di kelas ini
            $siswa = SiswaModel::whereNotIn('nis', $siswa_kelas->pluck('siswa_id')->toArray())
                ->get();

            return view('walas\siswa\index', [
                'breadcrumb' => $breadcrumb,
                'siswa_kelas' => $siswa_kelas,
                'siswa' => $siswa,
                'kelas' => $kelas,
                'kelas_id' => $kelas_id,
                'activeMenu' => $activeMenu
            ]);
        }
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
