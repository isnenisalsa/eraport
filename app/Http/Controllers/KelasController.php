<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];


        $activeMenu = 'kelas';
        $kelas = KelasModel::with('guru')->get();
      
        return view('admin.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'activeMenu' => $activeMenu]);
    }
}
