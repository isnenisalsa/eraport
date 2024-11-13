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
            'terms' => 'required'
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
            'terms.required' => 'wajib di centang'

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
            'alamat' => $request->alamat,
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
    public function edit($nik)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Guru',
        ];

        $activeMenu = 'guru';
        $guru = GuruModel::where('nik', $nik)->first();



        if (!$guru) {
            return redirect()->route('guru.index')->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin.guru.update', ['breadcrumb' => $breadcrumb, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, $nik)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|max:16',
            'status_perkawinan' => 'required',
            'status' => 'required',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'pendidikan_terakhir' => 'required',
            'no_telp' => 'required|numeric',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'nama_ibu' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
        ]);

        // Cari guru berdasarkan ID
        $guru = GuruModel::findOrFail($nik);

        // Perbarui data guru dengan data dari form
        $guru->update([
            'nik' => $request->input('nik'),
            'status_perkawinan' => $request->input('status_perkawinan'),
            'status' => $request->input('status'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'jabatan' => $request->input('jabatan'),
            'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
            'no_telp' => $request->input('no_telp'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'agama' => $request->input('agama'),
            'nama_ibu' => $request->input('nama_ibu'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
        ]);

        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('index')->with('success', 'Data guru berhasil diperbarui');
    }
}
