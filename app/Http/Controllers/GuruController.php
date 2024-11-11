<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {

        $breadcrumb = (object) [
            'title' => 'Daftar User',
        ];


        $activeMenu = 'guru';
        $guru = GuruModel::all();

        return view('admin\guru\index', ['breadcrumb' => $breadcrumb, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'tambah data guru',
        ];


        $activeMenu = 'guru';
        $guru = GuruModel::all();

        return view('admin.guru.create', ['breadcrumb' => $breadcrumb, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nama_ibu' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'pendidikan_terakhir' => 'required',
            'status_perkawinan' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'roles_id' => 'required',

        ]);
        GuruModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_ibu' => $request->nama_ibu,
            'agama' => $request->agama,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'no_telp' => $request->no_telp,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'status_perkawinan' => $request->status_perkawinan,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles_id,
        ]);
        return redirect()->route('index');
    }
}
