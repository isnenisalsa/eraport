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

public function biodata($nis)
{
    
    // Breadcrumb untuk halaman
    $breadcrumb = (object) [
        'title' => 'Biodata Siswa',
    ];

    $activeMenu = 'cetak-rapor';

    $siswa = SiswaModel::where('nis', $nis)->firstOrFail();

    return view('walas.cetak_rapor.biodata', compact('siswa'));
}
public function kelasRaporSiswa()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pembelajaran',
        ];

        $activeMenu = 'Pembelajaran Siswa';
        $user =  Auth::guard('siswa')->user();
        $kelas = SiswaKelasModel::with('siswa', 'kelas')->where('siswa_id', $user->nis)->get();

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kelas' => $kelas]);
    }
    public function KelasRaporSiswaCetak($id)
    {
        $breadcrumb = (object) [
            'title' => 'Cetak Rapor',
        ];

        $activeMenu = 'Pembelajaran Siswa';
        $user =  Auth::guard('siswa')->user();
        $kelas = SiswaKelasModel::with('siswa', 'kelas')->where('siswa_id', $user->nis)->get();

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.cetak', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kelas' => $kelas]);
    }
}