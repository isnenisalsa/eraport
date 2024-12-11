<?php

namespace App\Http\Controllers;

use App\Models\MapelModel;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {

        $breadcrumb = (object) [
            'title' => 'Data Mapel',
        ];

        $activeMenu = 'mapel';
        $mapel = MapelModel::all();


        return view('admin.mapel.index', ['breadcrumb' => $breadcrumb, 'mapel' => $mapel,  'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validateWithBag(

            'tambahBag',
            [
                'kode_mapel' => 'required|unique:mapel,kode_mapel', // Aturan validasi yang benar
                'mata_pelajaran' => 'required',
            ],
            [
                'kode_mapel.required' => 'Kode Mapel tidak boleh kosong',
                'kode_mapel.unique' => 'Kode Mapel harus unik',
                'mata_pelajaran.required' => 'Mata Pelajaran tidak boleh kosong',
            ]
        );

        MapelModel::create([
            'kode_mapel' => $request->kode_mapel,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);
        return redirect()->route('mapel');
    }
    public function update(Request $request, $kode_mapel)
    {
        $request->validateWithBag(
            'editBag',
            [
                'mata_pelajaran' => 'required',
                'terms' => 'required'
            ],
            [
                'terms.required' => 'Wajib dicentang'
            ]
        );
        $mapel = MapelModel::findOrFail($kode_mapel);

        // Perbarui data guru dengan data dari form
        $mapel->update([
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);
        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('mapel')->with('success', 'Data guru berhasil diperbarui');
    }
}
