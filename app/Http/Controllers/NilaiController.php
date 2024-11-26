<?php

namespace App\Http\Controllers;

use App\Models\PembelajaranModel;
use App\Models\SiswaKelasModel;
use App\Models\TujuanPembelajaranModel;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index($id)
    {
        $pembelajaran = PembelajaranModel::where('id_pembelajaran', $id)->get();
        //siswa
        $siswa = SiswaKelasModel::where('kelas_id', $id)->get();
        //tupel
        $tupel = TujuanPembelajaranModel::where('pembelajaran_id', $id)->get();
        $breadcrumb = (object)[
            'title' => 'DATA PEMBELAJARAN',
        ];
        $activeMenu =  'pembelajaran';

        return view('guru.nilai.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'pembelajaran' => $pembelajaran,
            'siswa' => $siswa,
            'tupel' => $tupel
        ]);
    }

    
}
