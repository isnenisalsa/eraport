<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\PembelajaranModel;
use Illuminate\Support\Facades\DB;

use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use Illuminate\Support\Facades\Auth;

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
    $user = Auth::user();
   
    $pembelajaran_guru = PembelajaranModel::where('nama_guru',$user->nik)->get()->count();

    $pembelajaran_walas = KelasModel::where('guru_nik', $user->nik)->get()->count();
    //dd($pembelajaran_walas);
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
        //'dataKelasWalasCount' => $dataKelasWalasCount,
        'pembelajaran_guru' => $pembelajaran_guru,
        'pembelajaran_walas' => $pembelajaran_walas,
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
