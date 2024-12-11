<?php

namespace App\Http\Controllers;

use App\Models\TahunAjarModel;
use Illuminate\Http\Request;

class TahunajaranController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Tahun Ajaran',
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
                'tahun_ajaran' => 'required',
                'semester' => 'required'
            ],
            [
                'tahun_ajaran.required' => 'Tahun Ajaran tidak boleh kosong',
                'semester.required' => 'Semester tidak boleh kosong',
            ]
        );

        // Simpan data
        TahunAjarModel::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester
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
                'semester' => 'required'
            ]
        );

        // Cari data berdasarkan kode_tahun_ajaran
        $tahun_ajaran = TahunAjarModel::findOrFail($kode_tahun_ajaran);

        // Update data
        $tahun_ajaran->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester
        ]);

        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('tahun_ajaran')->with('success', 'Data Tahun Ajaran berhasil diperbarui.');
    }
}
