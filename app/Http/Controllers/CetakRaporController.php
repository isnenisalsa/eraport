<?php

namespace App\Http\Controllers;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CetakRaporController extends Controller
{
    public function index($id)
    {
        $breadcrumb = (object) [
            'title' => 'Absensi Kelas',
        ];
        $activeMenu = 'absensi';

        // Ambil data kelas berdasarkan kelas_id
        $kelas = KelasModel::where('kode_kelas', $id)->firstOrFail();

        // Ambil semua siswa yang terdaftar di kelas ini dengan nama siswa
        $siswa = SiswaKelasModel::with('siswa') // eager load relasi siswa
                                ->where('kelas_id', $id)
                                ->get();

        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'siswa', 'activeMenu'));
    }
    public function kelasRapor()
    {
        $breadcrumb = (object) [
            'title' => 'Absensi Kelas',
        ];
        $activeMenu = 'absensi';
        $user = Auth::user();

        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();

        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'activeMenu'));
    }
}
