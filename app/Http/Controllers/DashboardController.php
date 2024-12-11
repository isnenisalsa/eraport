<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
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

    return view('dashboard.index', [
        'breadcrumb' => $breadcrumb,
        'activeMenu' => $activeMenu,
        'kelas' => $kelas,
    ]);
}

}
