<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];

        $activeMenu = 'kelas';
        $kelas = KelasModel::with('guru', 'tahunAjarans')->get();
        foreach ($kelas as $item) {
            $item->selectedTahunAjaran = $item->tahunAjarans->pluck('id')->toArray();
        }
        $guru = GuruModel::all();
        $tahun = TahunAjarModel::all();

        return view('admin.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'guru' => $guru, 'tahun' => $tahun, 'activeMenu' => $activeMenu]);
    }
    public function KelasWalas()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];

        $activeMenu = 'Data Kelas';
        $user = Auth::user();
        $kelas = KelasModel::where('guru_nik', $user->nik)->value('guru_nik');
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa']) // Menghitung jumlah siswa dan memberikan nilai default 0 jika tidak ada
            ->where('guru_nik', $kelas)
            ->get();
        return view('walas.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas,  'activeMenu' => $activeMenu]);
    }
    public function KelasWalasNilai()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];

        $activeMenu = 'Data Nilai Akhir';
        $user = Auth::user();
        $kelas = KelasModel::where('guru_nik', $user->nik)->value('guru_nik');
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa']) // Menghitung jumlah siswa dan memberikan nilai default 0 jika tidak ada
            ->where('guru_nik', $kelas)
            ->get();

        return view('walas.nilaiakhir.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas,  'activeMenu' => $activeMenu]);
    }


    public function save(Request $request)
    {
        // Validasi input
        $request->validateWithBag('tambahBag', [
            'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas',
            'nama_kelas' => 'required|string|max:255',
            'guru_nik' => 'required|exists:guru,nik',
            'tahun_ajaran_id' => 'required|array',
            'tahun_ajaran_id.*' => 'exists:tahun_ajaran,id',
        ], [
            'kode_kelas.required' => 'Kode kelas wajib diisi.',
            'kode_kelas.unique' => 'Kode kelas sudah terdaftar.',
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'guru_nik.required' => 'Wali kelas wajib dipilih.',
            'guru_nik.exists' => 'Wali kelas tidak valid.',
            'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih.',
            'tahun_ajaran_id.*.exists' => 'Tahun ajaran tidak valid.',
        ]);

        // Buat entri baru di tabel kelas
        $kelas = KelasModel::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
        ]);

        // Simpan data ke tabel pivot kelas_tahun_ajaran dengan kode_kelas
        $tahunAjaranData = [];
        foreach ($request->tahun_ajaran_id as $tahunAjaranId) {
            $tahunAjaranData[] = [
                'kelas_kode' => $request->kode_kelas,
                'tahun_ajaran_id' => $tahunAjaranId,
            ];
        }

        // Simpan data ke tabel pivot
        $kelas->tahunAjarans()->attach($tahunAjaranData);
        // Redirect ke halaman kelas dengan pesan sukses
        $roleIdToattach = 3;
        // Ambil guru berdasarkan guru_nik
        $guruBaru = GuruModel::where('nik', $request->guru_nik)->first();
        if ($guruBaru) {
            $guruBaru->roles()->syncWithoutDetaching([$roleIdToattach]);
        }
        return redirect()->route('kelas')->with('success', 'Data kelas berhasil disimpan.');
    }







    public function update(Request $request, $kode_kelas)
    {
        $request->validateWithBag(
            'editBag',
            [
                'nama_kelas' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tahun_ajaran_id' => 'required|array',
                'tahun_ajaran_id.*' => 'exists:tahun_ajaran,id',
            ],
            [
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih',
                'tahun_ajaran_id.*.exists' => 'Tahun ajaran tidak valid',
            ]
        );

        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->firstOrFail();

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
        ]);

        // Update relasi dengan tahun ajaran
        $kelas->tahunAjarans()->sync($request->tahun_ajaran_id);

        return redirect()->route('kelas')->with('success', 'Data kelas berhasil diperbarui');
    }
}
