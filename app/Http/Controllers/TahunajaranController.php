<?php

namespace App\Http\Controllers;

use App\Models\TahunAjarModel;
use Illuminate\Http\Request;

class TahunajaranController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Tahun Ajaran',
        ];

        $activeMenu = 'Tahun Ajaran';
        // Pastikan model yang benar digunakan
        $tahun_ajaran = TahunAjarModel::all();

        return view('admin.tahun_ajaran.index', [
            'breadcrumb' => $breadcrumb,
            'tahun_ajaran' => $tahun_ajaran,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function save(Request $request)
    {
        // Validasi input data
        $request->validateWithBag(
            'tambahBag',
            [
            'tahun_ajaran' => 'required|unique:tahun_ajaran',
            'terms' => 'required',
        ], [
            'tahun_ajaran.required' => 'Tahun Ajaran tidak boleh kosong',
            'tahun_ajaran.unique' => 'Tahun Ajaran tidak boleh Sama',
            'terms.required' => 'Wajib dicentang'
        ]);

        // Simpan data
        TahunAjarModel::create([
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('tahun_ajaran')->with('success', 'Data Tahun Ajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $kode_tahun_ajaran)
    {
        // Validasi input data
        $request->validate(
            [
                'tahun_ajaran' => 'required',
            ]
        );

        // Cari data berdasarkan kode_tahun_ajaran
        $tahun_ajaran = TahunAjarModel::findOrFail($kode_tahun_ajaran);

        // Update data
        $tahun_ajaran->update([
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);

        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('tahun_ajaran')->with('success', 'Data Tahun Ajaran berhasil diperbarui.');
    }
}