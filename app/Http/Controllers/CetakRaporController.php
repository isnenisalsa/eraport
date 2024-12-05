<?php

namespace App\Http\Controllers;
use App\Models\KelasModel;
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


    public function index($nis)
{
    $breadcrumb = (object) [
        'title' => 'Rapor Kelas',
    ];
    $activeMenu = 'absensi';

    // Ambil data kelas berdasarkan kode_kelas
    $kelas = KelasModel::with(['guru'])->where('kode_kelas', $nis)->firstOrFail();

    // Ambil semua siswa yang terdaftar di kelas ini
    $siswa = SiswaKelasModel::with('siswa')
                        ->where('kelas_id', $nis)
                        ->get();

    return view('walas.cetak_rapor.cetak', compact('breadcrumb', 'kelas', 'siswa', 'activeMenu'));
}


public function show($kode_kelas)
{
    $breadcrumb = (object) [
        'title' => 'Detail Kelas',
    ];

    $kelas = KelasModel::with(['guru', 'siswa'])
                   ->where('kode_kelas', $kode_kelas)
                   ->firstOrFail();

$siswa = $kelas->siswa; // Relasi siswa harus sudah didefinisikan di KelasModel


    return view('cetak.detail', compact('breadcrumb', 'kelas', 'siswa'));
}


}
