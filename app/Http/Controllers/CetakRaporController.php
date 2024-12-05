<?php

namespace App\Http\Controllers;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\SiswaKelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CetakRaporController extends Controller
{
    public function kelasRapor()
    {
        $breadcrumb = (object) [
            'title' => 'Rapor Kelas',
        ];
        $activeMenu = 'Rapor';
        $user = Auth::user();

        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();

        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'activeMenu'));
    }

   
    public function index($kode_kelas)
{
    
    // Breadcrumb untuk halaman
    $breadcrumb = (object) [
        'title' => 'Biodata Siswa',
    ];

    $activeMenu = 'cetak-rapor';

    // Ambil data kelas berdasarkan kode_kelas
    $kelas = KelasModel::with(['guru', 'siswa'])->where('kode_kelas', $kode_kelas)->firstOrFail();

    // Ambil siswa yang terdaftar di kelas
    $siswa = $kelas->siswa; // Relasi siswa harus sudah ada di KelasModel
    // Kirim data ke view
    return view('walas.cetak_rapor.cetak', compact('breadcrumb', 'kelas', 'siswa', 'activeMenu'));
}


public function cover($nis)
{
    $siswa = SiswaModel::where('nis', $nis)->firstOrFail();

    return view('walas.cetak_rapor.cover', compact('siswa'));
}
}
