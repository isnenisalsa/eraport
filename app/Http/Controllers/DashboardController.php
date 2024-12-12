<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use Illuminate\Support\Facades\DB;

use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'DASHBOARD',
        ];
        $activeMenu = 'dashboard';

        $kelas = KelasModel::all(); // Ambil semua kelas untuk ditampilkan
{
    $breadcrumb = (object)[
        'title' => 'DASHBOARD',
    ];
    $activeMenu = 'dashboard';
    // Ambil jumlah data siswa
    $dataSiswaCount = DB::table('siswa')->count(); // Sesuaikan dengan nama tabel 'siswa'
    $dataGuruCount = DB::table('guru')->count();
    $dataTahunAjaranCount = DB::table('tahun_ajaran')->count();
    $dataKelasCount = DB::table('kelas')->count();
    $dataMapelCount = DB::table('mapel')->count();
    $dataPembelajaranCount = DB::table('pembelajaran')->count();
    $dataEskulCount = DB::table('eskul')->count();
    $dataKelasWalasCount = DB::table('kelas')->count();
    $dataPembelajaranGuruCount = DB::table('pembelajaran')->count();
    $kelas = KelasModel::all(); // Ambil semua kelas untuk ditampilkan

    return view('dashboard.index', [
        'breadcrumb' => $breadcrumb,
        'activeMenu' => $activeMenu,
        'kelas' => $kelas,
        'dataSiswaCount' => $dataSiswaCount,
        'dataGuruCount' => $dataGuruCount,
        'dataTahunAjaranCount' => $dataTahunAjaranCount,
        'dataKelasCount' => $dataKelasCount,
        'dataMapelCount' => $dataMapelCount,
        'dataPembelajaranCount' => $dataPembelajaranCount,
        'dataEskulCount' => $dataEskulCount,
        'dataKelasWalasCount' => $dataKelasWalasCount,
        'dataPembelajaranWalasCount' => $dataPembelajaranCount,
    ]);
}

        return view('dashboard.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'kelas' => $kelas,
        ]);
    }
    public function siswa()
    {
        $breadcrumb = (object)[
            'title' => 'DASHBOARD',
        ];
        $activeMenu = 'dashboard';

        $kelas = KelasModel::all(); // Ambil semua kelas untuk ditampilkan

        return view('dashboard.siswa', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'kelas' => $kelas,
        ]);
    }
}
