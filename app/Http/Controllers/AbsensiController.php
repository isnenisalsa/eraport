<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function KelasAbsensi()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];
        $activeMenu = 'Data Absensi';
        $user = Auth::user();

        // Ambil data kelas dengan relasi
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();

        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');
        // Urutkan secara menurun dan ambil tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->sortDesc()->first();
        // Ambil daftar semester dari model TahunAjarModel, urutkan secara descending
        $semester = TahunAjarModel::where('tahun_ajaran', $tahunAjaranTerbaru)->distinct('semester')->orderByDesc('semester')->pluck('semester');
        // Tentukan semester terbaru
        $semesterTerbaru = $semester->sortDesc()->first(); // Default semester terbaru
        return view('walas.absensi.index', compact(
            'breadcrumb',
            'kelas',
            'tahunAjaranTerbaru',
            'activeMenu',
            'tahunAjaran',
            'semester',
            'semesterTerbaru'
        ));
    }


    public function index($id, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'Absensi Kelas',
        ];
        $activeMenu = 'Data Absensi';

        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::where('kode_kelas', $id)->firstOrFail();

        // Ambil siswa yang memiliki data absensi pada tahun ajaran tertentu
        $siswa = SiswaKelasModel::with(['siswa', 'absensi' => function ($query) use ($tahun_ajaran_id) {
            $query->where('tahun_ajaran_id', $tahun_ajaran_id);
        }])
            ->where('kelas_id', $id)
            ->get();

        return view('walas.absensi.absensi', compact('breadcrumb', 'kelas', 'siswa', 'activeMenu', 'tahun_ajaran_id'));
    }



    public function update(Request $request, $kode_kelas, $tahun_ajaran_id)
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
                    'tahun_ajaran_id' => $tahun_ajaran_id

                ],
                [
                    'sakit' => $data['sakit'] ?? 0,
                    'izin' => $data['izin'] ?? 0,
                    'alfa' => $data['alfa'] ?? 0,
                ]
            );
        }

        return redirect()->back()->with('success', 'Status absensi berhasil diperbarui.');
    }
}
