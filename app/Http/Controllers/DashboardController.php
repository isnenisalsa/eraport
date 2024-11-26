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
        return view('dashboard.admin', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu]);
    }
    public function guru()
    {

        $breadcrumb = (object)[
            'title' => 'DASHBOARD',

        ];
        $activeMenu =  'dashboard guru';
        return view('dashboard.guru', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu]);
    }
    public function walas()
    {
        $breadcrumb = (object)[
            'title' => 'DASHBOARD',

        ];
        $activeMenu =  'dashboard walas';
        return view('dashboard.walas', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu]);
    }
}
