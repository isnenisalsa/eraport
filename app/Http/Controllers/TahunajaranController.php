<?php

namespace App\Http\Controllers;

use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
    public function list()
    {
        $tahun_ajaran = TahunAjarModel::select(['id', 'tahun_ajaran', 'semester', 'tanggal_biodata', 'tanggal_pembagian_rapor'])->get();

        return DataTables::of($tahun_ajaran)
            ->addIndexColumn() // Tambahkan nomor urut
            ->make(true);
    }
    public function save(Request $request)
    {
        // Validasi input data
        $request->validateWithBag(
            'tambahBag',
            [
                'tahun_ajaran' => 'required|regex:/^[0-9\/]+$/',
                'semester' => 'required',
                'tanggal_biodata' => 'required',
                'tanggal_pembagian_rapor' => 'required'
            ],
            [
                'tahun_ajaran.required' => 'Tahun ajaran tidak boleh kosong',
                'tahun_ajaran.regex' => 'Tahun ajaran hanya boleh berisi angka dan karakter "/"',
                'semester.required' => 'Semester tidak boleh kosong',
                'tanggal_biodata.required' => 'Tanggal pengisian biodata tidak boleh kosong',
                'tanggal_pembagian_rapor.required' => 'Tanggal pembagian rapor tidak boleh kosong',
            ]
        );

        // Simpan data
        TahunAjarModel::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'tanggal_biodata' => $request->tanggal_biodata,
            'tanggal_pembagian_rapor' => $request->tanggal_pembagian_rapor,
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
