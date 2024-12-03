<?php

namespace App\Http\Controllers;

use App\Models\EskulModel;
use App\Models\GuruModel;
use Illuminate\Http\Request;

class EskulController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Eskul',
        ];


        $activeMenu = 'Eskul';
        $eskul = EskulModel::all();
        $guru = GuruModel::all();
        return view('admin.eskul.index', ['breadcrumb' => $breadcrumb, 'eskul' => $eskul, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validateWithBag(

            'tambahBag',
            [
                'nama_eskul' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tempat' => 'required',

            ],
            [
                'nama_eskul.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tempat.required' => 'Tahun ajaran wajib dipilih',

            ]
        );
        // Buat entri baru di tabel kelas
        EskulModel::create([
            'nama_eskul' => $request->nama_eskul,
            'guru_nik' => $request->guru_nik,
            'tempat' => $request->tempat,
        ]);

        // Ambil guru berdasarkan guru_nik
        $guru = GuruModel::find($request->guru_nik);
        $roleIdToattach = 4;

        // Tambahkan role baru
        $guru->roles()->attach($roleIdToattach);

        return redirect()->route('eskul.index')->with('success', 'data berhasil ditambah');
    }
    public function update(Request $request, $id)
    {
        $request->validateWithBag(

            'editBag',
            [
                'nama_eskul' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tempat' => 'required',

            ],
            [
                'nama_eskul.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tempat.required' => 'Tahun ajaran wajib dipilih',

            ]
        );
        $eskul = EskulModel::find($id);
        // Perbarui data guru dengan data dari form
        $eskul->update([

            'nama_eskul' => $request->input('nama_eskul'),
            'guru_nik' => $request->input('guru_nik'),
            'tempat' => $request->tempat,
        ]);

        $guru = GuruModel::find($request->guru_nik);
        $roleIdToDelete = 4;

        // Hapus role jika ada
        $guru->roles()->detach($roleIdToDelete);

        // Tambahkan role baru
        $guru->roles()->attach($roleIdToDelete);

        return redirect()->route('eskul.index')->with('success', 'Data Kelas berhasil diperbarui');
    }
}
