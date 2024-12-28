<?php

namespace App\Http\Controllers;

use App\Models\CapaianModel;
use App\Models\LingkupMateriModel;
use App\Models\PembelajaranModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;

class CapelController extends Controller
{
    public function index($id_pembelajaran, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'KELOLA TUJUAN PEMBELAJARAN',
        ];

        $activeMenu = 'Data Pembelajaran';
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->pluck('semester')->first();
        $Datacapel = CapaianModel::where('pembelajaran_id', $id_pembelajaran)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $DataLingkup = LingkupMateriModel::where('pembelajaran_id', $id_pembelajaran)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        $data = PembelajaranModel::with(['kelas', 'mapel', 'guru'])
            ->where('id_pembelajaran', $id_pembelajaran)
            ->first();

        return view('guru.capel.index', compact('Datacapel', 'data', 'tahun_ajaran_id', 'activeMenu', 'breadcrumb', 'id_pembelajaran', 'DataLingkup', 'semester'));
    }

    public function save(Request $request, $id_pembelajaran, $tahun_ajaran_id)
    {
        // Validasi input
        $request->validate([
            'lingkup_id' => 'required|exists:lingkup_materi,id',
            'nama_capel' => 'required|max:200',
        ], [
            'lingkup_id.required' => 'Lingkup Materi harus dipilih.',
            'lingkup_id.exists' => 'Lingkup Materi yang dipilih tidak valid.',
            'nama_capel.required' => 'Tujuan Pembelajaran tidak boleh kosong.',
            'nama_capel.max' => 'Tujuan Pembelajaran tidak boleh lebih dari 200 karakter.',
        ]);

        // Simpan data ke database
        CapaianModel::create([
            'pembelajaran_id' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'lingkup_id' => $request->lingkup_id,
            'nama_capel' => $request->nama_capel,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('capel.index', [
            'id_pembelajaran' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
        ])->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'id' => 'required|array',
                'id.*' => 'exists:capel,id', // Memastikan setiap ID ada di database
                'nama_capel' => 'required|array',
                'nama_capel.*' => 'string|max:200', // Memastikan setiap nama_capel valid
                'lingkup_id' => 'required|array',
                'lingkup_id.*' => 'exists:lingkup_materi,id', // Memastikan setiap lingkup_id ada di database
            ],
            [
                'nama_capel.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
                'lingkup_id.required' => 'Lingkup Materi Tidak Boleh Kosong',
                'lingkup_id.*.exists' => 'Lingkup Materi yang Dipilih Tidak Valid',
            ]
        );

        // Loop untuk memperbarui setiap capel
        foreach ($request->id as $index => $id) {
            $capel = CapaianModel::find($id);
            $capel->nama_capel = $request->nama_capel[$index];
            $capel->lingkup_id = $request->lingkup_id[$index];
            $capel->save(); // Simpan perubahan
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $capel = CapaianModel::findOrFail($id);
        $capel->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
