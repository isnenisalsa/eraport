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
       

        $activeMenu = 'guru'; //sert menu yang sudah aktif
        $guru = GuruModel::all(); //ambil data guru untuk filter guru

        return view('admin\guru\index', ['breadcrumb' => $breadcrumb, 'guru' => $guru, 'activeMenu' => $activeMenu ]);
    }
}
