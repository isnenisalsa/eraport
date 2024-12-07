<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'DASHBOARD',

        ];
        $activeMenu =  'dashboard ';
        return view('dashboard.index', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu]);
    }
    public function siswa()
    {
        $breadcrumb = (object)[
            'title' => 'DASHBOARD',

        ];
        $activeMenu =  'dashboard siswa';
        return view('dashboard.siswa', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu]);
    }
}
