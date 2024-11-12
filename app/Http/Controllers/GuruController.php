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
            'title' => 'Daftar Guru',
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
            'nik' => 'required|numeric|digits:16',
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
            'email' => 'required|email',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus  16 angka.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong.',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong.',
            'nama_ibu.required' => 'Nama ibu tidak boleh kosong.',
            'agama.required' => 'Agama tidak boleh kosong.',
            'jabatan.required' => 'Jabatan tidak boleh kosong.',
            'status.required' => 'Status tidak boleh kosong.',
            'no_telp.required' => 'Nomor telepon tidak boleh kosong.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir tidak boleh kosong.',
            'status_perkawinan.required' => 'Status perkawinan tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',

        ]);
        $username = strtolower(str_replace(' ', '_', $request->nama)); // Mengganti spasi dengan underscore
        $password = Hash::make($request->no_telp); // Menggunakan nomor telepon sebagai password yang di-hash
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
            'username' => $username,
            'password' => $password,
            'roles_id' => $request->roles_id,
        ]);
        return redirect()->route('index');
    }
}
