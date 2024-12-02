<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];


        $activeMenu = 'kelas';
        $kelas = KelasModel::with('guru', 'tahun_ajarans')->get();
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
        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
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
        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
            ->withCount(['siswa']) // Menghitung jumlah siswa dan memberikan nilai default 0 jika tidak ada
            ->where('guru_nik', $kelas)
            ->get();
        return view('walas.nilaiakhir.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas,  'activeMenu' => $activeMenu]);
    }


    public function save(Request $request)
    {
        $request->validateWithBag(

            'tambahBag',
            [
                'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas', // Validasi input
                'nama_kelas' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
                'terms' => 'required',
            ],
            [
                'kode_kelas.required' => 'Kode kelas wajib diisi',
                'kode_kelas.unique' => 'Kode kelas sudah terdafta',
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih',
                'tahun_ajaran_id.exists' => 'Tahun ajaran tidak valid',
                'terms.required' => 'Wajib dicentang'
            ]
        );
        // Buat entri baru di tabel kelas
        KelasModel::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'guru_nik' => $request->guru_nik,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
        ]);

        // Ambil guru berdasarkan guru_nik
        $guru = GuruModel::find($request->guru_nik);

        // Tambahkan role ke guru jika belum ada
        if (!$guru->roles()->where('role_id', 3)->exists()) {
            $guru->roles()->attach(3); // Menambahkan role dengan ID 3
        }

        return redirect()->route('kelas');
    }
    public function update(Request $request, $kode_kelas)
    {
        $request->validateWithBag(
            'editBag',
            [
                'nama_kelas' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
                'terms' => 'required',
            ],
            [
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih',
                'tahun_ajaran_id.exists' => 'Tahun ajaran tidak valid',
                'terms.required' => 'Wajib dicentang'

            ]
        );
        $kelas = KelasModel::find($kode_kelas);
        // Perbarui data guru dengan data dari form
        $kelas->update([

            'nama_kelas' => $request->input('nama_kelas'),
            'guru_nik' => $request->input('guru_nik'),
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
        ]);

        $guru = GuruModel::find($request->guru_nik);
        $roleIdToDelete = 3;

        // Hapus role jika ada
        $guru->roles()->detach($roleIdToDelete);

        // Tambahkan role baru
        $guru->roles()->attach($roleIdToDelete);

        return redirect()->route('kelas')->with('success', 'Data Kelas berhasil diperbarui');
    }
}
