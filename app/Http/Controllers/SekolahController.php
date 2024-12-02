<?php

namespace App\Http\Controllers;

use App\Models\SekolahModel;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = SekolahModel::first();
        $activeMenu = 'Data Sekolah';

        // Breadcrumb untuk tampilan
        $breadcrumb = (object) [
            'title' => 'Data Sekolah',
        ];

        return view('admin.sekolah.index', [
            'breadcrumb' => $breadcrumb,
            'sekolah' => $sekolah,
            'activeMenu' => $activeMenu,
        ]);
    }


    public function save(Request $request)
    {

        $request->validate([
            // Validasi data yang masuk dari formulir
            'nama' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'nss' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'nama_kepsek' => 'nullable|string',
            'nip_kepsek' => 'nullable|string',
        ]);

        SekolahModel::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->nama,
                'npsn' => $request->npsn,
                'nss' => $request->nss,
                'alamat' => $request->alamat,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'nama_kepsek' => $request->nama_kepsek,
                'nip_kepsek' => $request->nip_kepsek,
            ]
        );


        return redirect()->route('sekolah.index')->with('success', 'Data sekolah berhasil disimpan');
    }
}
