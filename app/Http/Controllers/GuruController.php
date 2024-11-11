<?php

namespace App\Http\Controllers;
use App\Models\GuruModel;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
        ];
       

        $activeMenu = 'guru'; 
        $guru = GuruModel::all(); 

        return view('admin\guru\index', ['breadcrumb' => $breadcrumb, 'guru' => $guru, 'activeMenu' => $activeMenu ]);
    }
}
