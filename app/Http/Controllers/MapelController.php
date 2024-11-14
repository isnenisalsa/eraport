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
            'title' => 'Daftar Mapel',
        ];

        $activeMenu = 'mapel';
        $mapel = MapelModel::all();


        return view('admin.mapel.index', ['breadcrumb' => $breadcrumb, 'mapel' => $mapel,  'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required', // Aturan validasi yang benar
            'mata_pelajaran' => 'required',
        ]);

        MapelModel::create([
            'kode_mapel' => $request->kode_mapel,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);
        return redirect()->route('mapel');
    }
    public function update(Request $request, $kode_mapel)
    {
        $request->validate([
            'kode_mapel' => 'required',
            'mata_pelajaran' => 'required',
        ]);
        $mapel = MapelModel::findOrFail($kode_mapel);

        // Perbarui data guru dengan data dari form
        $mapel->update([
            'kode_mapel' => $request->input('kode_mapel'),
            'mata_pelajaran' => $request->input('mata_pelajaran'),
        ]);

        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('mapel')->with('success', 'Data guru berhasil diperbarui');
    }
}
