<?php

namespace App\Http\Controllers;

use App\Models\MapelModel;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
    public function list()
    {
        $mapels = MapelModel::select(['kode_mapel', 'mata_pelajaran'])->get();

        return DataTables::of($mapels)
            ->addIndexColumn() // Tambahkan nomor urut
            ->make(true);
    }

    public function save(Request $request)
    {
        $request->validateWithBag(
            'tambahBag',
            [
                'mata_pelajaran' => 'required',
            ],
            [
                'mata_pelajaran.required' => 'Mata pelajaran tidak boleh kosong',
            ]
        );

        // Generate kode_mapel otomatis
        $lastMapel = MapelModel::latest('kode_mapel')->first();
        if ($lastMapel) {
            // Ambil angka terakhir dari kode_mapel dan tambahkan 1
            $lastNumber = (int) substr($lastMapel->kode_mapel, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format kode_mapel baru
        $kodeMapel = 'MP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Simpan data ke tabel mapel
        MapelModel::create([
            'kode_mapel' => $kodeMapel,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        return redirect()->route('mapel')->with('success', 'Data Mata Pelajaran berhasil disimpan.');
    }

    public function update(Request $request, $kode_mapel)
    {
        $request->validateWithBag(
            'editBag',
            [
                'mata_pelajaran' => 'required',
            ],
            [
                'mata_pelajaran.required' => 'Mata pelajaran tidak boleh kosong'
            ]
        );
        $mapel = MapelModel::findOrFail($kode_mapel);

        // Perbarui data guru dengan data dari form
        $mapel->update([
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);
        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('mapel')->with('success', 'Data Mata Pelajaran berhasil diperbarui');
    }
}
