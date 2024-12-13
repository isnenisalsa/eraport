<?php

namespace App\Http\Controllers;

use App\Models\CapaianModel;
use App\Models\PembelajaranModel;
use Illuminate\Http\Request;

class CapelController extends Controller
{
    public function index($id_pembelajaran, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'KELOLA CAPAIAN PEMBELAJARAN',
        ];

        $activeMenu = 'Data Pembelajaran';
        $Datacapel = CapaianModel::where('pembelajaran_id', $id_pembelajaran)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();

        $data = PembelajaranModel::with(['kelas', 'mapel', 'guru'])
            ->where('id_pembelajaran', $id_pembelajaran)
            ->first();

        return view('guru.capel.index', compact('Datacapel', 'data', 'tahun_ajaran_id', 'activeMenu', 'breadcrumb', 'id_pembelajaran'));
    }

    public function save(Request $request, $id_pembelajaran, $tahun_ajaran_id)
    {
        $request->validate(
            [
                'nama_capel.*' => 'required|regex:/^[a-zA-Z\s]+$/',
            ],
            [
                'nama_capel.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
                'nama_capel.regex' => 'Tujuan Pembelajaran Tidak Boleh berisi Angka',
            ]
        );
        CapaianModel::create([
            'pembelajaran_id' => $id_pembelajaran,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'nama_capel' => $request->nama_capel,
        ]);
        return redirect()->route('capel.index', [
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
                'id.*' => 'exists:capel,id', // Memastikan setiap ID ada di database
                'nama_capel' => 'required|array',
                'nama_capel.*' => 'string|max:255|regex:/^[a-zA-Z0-9\s]+$/', // Memastikan setiap nama_capel valid
            ],
            [
                'nama_capel.required' => 'Tujuan Pembelajaran Tidak Boleh Kosong',
                'nama_capel.*.regex' => 'Tujuan Pembelajaran hanya boleh berisi huruf dan spasi.',
            ]
        );

        // Loop untuk memperbarui setiap capel
        foreach ($request->id as $index => $id) {
            $capel = CapaianModel::find($id);
            $capel->nama_capel = $request->nama_capel[$index];
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
