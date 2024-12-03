<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function KelasAbsensi()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Absensi',
        ];
        $activeMenu = 'Data Absensi';
        $user = Auth::user();

        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();

        return view('walas.absensi.index', compact('breadcrumb', 'kelas', 'activeMenu'));
    }

    public function index($id)
{
    $breadcrumb = (object) [
        'title' => 'Absensi Kelas',
    ];
    $activeMenu = 'absensi';

    // Ambil data kelas berdasarkan kelas_id
    $kelas = KelasModel::where('kode_kelas', $id)->firstOrFail();

    // Ambil semua siswa yang terdaftar di kelas ini dengan nama siswa
    $siswa = SiswaKelasModel::with('siswa') // eager load relasi siswa
                            ->where('kelas_id', $id)
                            ->get();

    return view('walas.absensi.absensi', compact('breadcrumb', 'kelas', 'siswa', 'activeMenu'));
}


public function update(Request $request, $kode_kelas)
{
    $request->validate([
        'siswa.*.id' => 'required|exists:siswa_kelas,id',
        'siswa.*.sakit' => 'integer|min:0',
        'siswa.*.izin' => 'integer|min:0',
        'siswa.*.alfa' => 'integer|min:0',
    ]);

    foreach ($request->input('siswa') as $data) {
        AbsensiModel::updateOrCreate(
            [
                'siswa_id' => $data['id'], // Pastikan 'id' sesuai dengan yang dikirimkan dari form
                'kode_kelas' => $kode_kelas,
            ],
            [
                'sakit' => $data['sakit'] ?? 0,
                'izin' => $data['izin'] ?? 0,
                'alfa' => $data['alfa'] ?? 0,
            ]
        );
    }

    return redirect()->route('absensi.index', $kode_kelas)
                     ->with('success', 'Data absensi berhasil diperbarui.');
}
public function show($kode_kelas)
{
    $kelas = KelasModel::with('guru')->where('kode_kelas', $kode_kelas)->firstOrFail();

    return view('kelas.detail', compact('kelas'));
}


}
