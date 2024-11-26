<?php

namespace App\Http\Controllers;

use App\Models\PembelajaranModel;
use App\Models\TujuanPembelajaranModel;
use Illuminate\Http\Request;

class TujuanPembelajaranController extends Controller
{
    public function index($id)
    {
        $breadcrumb = (object) [
            'title' => 'DAFTAR TUJUAN PEMBELAJARAN',
        ];

        $activeMenu = 'Data Pembelajaran';
        // Ambil pengguna dengan ID 1 (atau ID yang Anda inginkan)
        $tupel = TujuanPembelajaranModel::find($id);
        $DataTupel = TujuanPembelajaranModel::where('pembelajaran_id', $id)->get();
        // Ganti 1 dengan ID pengguna yang ingin Anda tampilkan
        $data = PembelajaranModel::where('id_pembelajaran', $id)->get();
        // Jika pengguna tidak ditemukan, $user akan bernilai null
        return view('guru.tupel.index', ['breadcrumb' => $breadcrumb, 'tupel' => $tupel, 'data' => $data, 'DataTupel' => $DataTupel, 'id' => $id, 'activeMenu' => $activeMenu]);
    }
    public function save(Request $request, $id)
    {
        $request->validate(
            [
                'nama_tupel' => 'required|regex:/^[a-zA-Z\s]+$/',
            ],
            [
                'nama_tupel.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
                'nama_tupel.regex' => 'Tujuan Pembelajaran Tidak Boleh berisi Angka',
            ]
        );
        TujuanPembelajaranModel::create([
            'pembelajaran_id' => $id,
            'nama_tupel' => $request->nama_tupel,
        ]);
        return redirect()->route('tupel.index', ['id' => $id])->with('success', 'Data berhasil disimpan');
    }
    public function update(Request $request)
    {

        // Validasi input
        $request->validate(
            [
                'id' => 'required|array',
                'id.*' => 'exists:tupel,id', // Memastikan setiap ID ada di database
                'nama_tupel' => 'required|array',
                'nama_tupel.*' => 'string|max:255|regex:/^[a-zA-Z\s]+$/', // Memastikan setiap nama_tupel valid
            ],
            [
                'nama_tupel.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
                'nama_tupel.regex' => 'Tujuan Pembelajaran Tidak Boleh berisi Angka',
            ]
        );

        // Loop untuk memperbarui setiap tupel
        foreach ($request->id as $index => $id) {
            $tupel = TujuanPembelajaranModel::find($id);
            $tupel->nama_tupel = $request->nama_tupel[$index];
            $tupel->save(); // Simpan perubahan
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $tupel = TujuanPembelajaranModel::findOrFail($id);
        $tupel->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
