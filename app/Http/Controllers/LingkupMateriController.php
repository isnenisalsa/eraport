<?php

namespace App\Http\Controllers;

use App\Models\LingkupMateriModel;
use App\Models\PembelajaranModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;

class LingkupMateriController extends Controller
{
    public function index($id_pembelajaran, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'Data Lingkup Materi',
        ];

        $activeMenu = 'Data Pembelajaran';
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->pluck('semester')->first();
        $DataLingkup = LingkupMateriModel::where('pembelajaran_id', $id_pembelajaran)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $data = PembelajaranModel::with(['kelas', 'mapel', 'guru'])
            ->where('id_pembelajaran', $id_pembelajaran)
            ->first();

        return view('guru.lingkup_materi.index', [
            'data' => $data,
            'DataLingkup' => $DataLingkup,
            'id_pembelajaran' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'semester' => $semester
        ]);
    }
    public function save(Request $request, $id_pembelajaran, $tahun_ajaran_id)
    {
        $request->validate([
            'nama_lingkup_materi' => 'required|max:200',
        ], [
            'nama_lingkup_materi.required' => 'Nama lingkup materi tidak boleh kosong.',
            'nama_lingkup_materi.max' => 'Nama lingkup materi tidak boleh lebih dari 200 karakter.',
        ]);


        LingkupMateriModel::create([
            'pembelajaran_id' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'nama_lingkup_materi' => $request->nama_lingkup_materi,
        ]);
        return redirect()->route('lingkup.index', [
            'id_pembelajaran' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id
        ])->with('success', 'Data berhasil disimpan');
    }
    public function update(Request $request)
    {

        // Validasi input
        $request->validate(
            [
                'id' => 'required|array',
                'id.*' => 'exists:lingkup_materi,id', // Memastikan setiap ID ada di database
                'nama_lingkup_materi' => 'required|array',
                'nama_lingkup_materi.*' => 'string|max:200', // Memastikan setiap nama_lingkup_materi valid
            ],
            [
                'nama_lingkup_materi.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
            ]
        );

        // Loop untuk memperbarui setiap capel
        foreach ($request->id as $index => $id) {
            $capel = LingkupMateriModel::find($id);
            $capel->nama_lingkup_materi = $request->nama_lingkup_materi[$index];
            $capel->save(); // Simpan perubahan
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $capel = LingkupMateriModel::findOrFail($id);
        $capel->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
