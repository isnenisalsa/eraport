<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CapaianModel;
use App\Models\KelasModel;
use App\Models\PembelajaranModel;
use App\Models\SiswaModel;
use App\Models\SiswaKelasModel;
use App\Models\SekolahModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CetakRaporController extends Controller
{
    public function kelasRapor()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];
        $activeMenu = 'Cetak Rapor';
        $user = Auth::user();
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();
        // Ambil tahun ajaran unik
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');

        // Tentukan tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->first();

        // Ambil daftar semester dari model TahunAjarModel, urutkan secara descending
        $semester = TahunAjarModel::distinct('semester')->orderByDesc('semester')->pluck('semester');

        // Tentukan semester terbaru
        $semesterTerbaru = $semester->first(); // Default semester terbaru


        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'activeMenu', 'tahunAjaran', 'tahunAjaranTerbaru', 'semester', 'semesterTerbaru'));
    }
    public function index($kode_kelas, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'Rapor Kelas',
        ];

        $activeMenu = 'Cetak Rapor';
        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::with(['guru'])->where('kode_kelas', $kode_kelas)->firstOrFail();
        // Ambil semua siswa yang terdaftar di kelas ini
        $siswa = SiswaKelasModel::with('siswa')
            ->where('kelas_id', $kode_kelas)
            ->get();
        return view('walas.cetak_rapor.cetak', compact('breadcrumb', 'kelas', 'siswa', 'kode_kelas', 'activeMenu', 'tahun_ajaran_id'));
    }

    public function cover($nis)
    {
        // Ambil data siswa berdasarkan NIS
        $siswa = SiswaModel::where('nis', $nis)->first();
        // Render view menjadi PDF
        $pdf = Pdf::loadView('walas.cetak_rapor.cover', compact('siswa'));

        // Tampilkan PDF di browser
        return $pdf->stream($nis . '_' . $siswa->nama . '_' . 'cover' . '.pdf');

        // Jika ingin langsung download:
        // return $pdf->download('cover_rapor_' . $nis . '.pdf');
    }

    public function biodata($nis)
    {
        // Breadcrumb untuk halaman
        $breadcrumb = (object) [
            'title' => 'Biodata Siswa',
        ];

        $activeMenu = 'cetak Rapor';

        $siswa = SiswaModel::where('nis', $nis)->first();

        $sekolah = SekolahModel::all();

        // Membuat view untuk PDF
        $pdf = PDF::loadView('walas.cetak_rapor.biodata', compact('siswa', 'sekolah'));

        // Mengirimkan PDF untuk diunduh atau ditampilkan
        return $pdf->download($nis . '_' . $siswa->nama . '_' . 'biodata' . '.pdf'); // Untuk mengunduh
        // return $pdf->stream('biodata_siswa.pdf'); // Untuk menampilkan
    }

    public function rapor($kode_kelas, $nis, $tahun_ajaran_id)
    {
        $siswa = SiswaModel::where('nis', $nis)->first();
        $kelas = KelasModel::with('guru')->get();
        $sekolah = SekolahModel::firstOrFail();

        // Ambil data absensi siswa, jika tidak ada tampilkan '-'
        $siswa_absen = SiswaKelasModel::where('siswa_id', $nis)
            ->whereHas('absensi', function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id);
            })
            ->with(['absensi' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id);
            }])
            ->first();

        if (!$siswa_absen) {
            $siswa_absen = (object) ['absensi' => '-'];
        }

        // Ambil data pembelajaran
        $pembelajaran = PembelajaranModel::where('nama_kelas', $kode_kelas)->get();

        $siswa_nilai = SiswaKelasModel::where('siswa_id', $nis)
            ->whereHas('nilai', function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->where('nilai_rapor', '>', 0);
            })
            ->with(['nilai' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->where('nilai_rapor', '>', 0);
            }])
            ->first();

        if (!$siswa_nilai) {
            $siswa_nilai = (object) ['nilai' => collect()];
        }

        $siswa_eskul = SiswaKelasModel::where('siswa_id', $nis)
            ->with(['nilaieskul' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id);
            }, 'nilaieskul.eskul'])
            ->get();

        $nilai = SiswaKelasModel::where('siswa_id', $nis)
            ->whereHas('nilai', function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->whereNotNull('capel_id');
            })
            ->with(['nilai.capel' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->select('id', 'nama_capel');
            }])
            ->get()
            ->map(function ($item) {
                return [
                    'siswa_id' => $item->siswa_id,
                    'nilai' => $item->nilai->filter(function ($nilai_item) {
                        return $nilai_item->capel_id !== null;
                    })->map(function ($nilai_item) {
                        return [
                            'pembelajaran_id' => $nilai_item->pembelajaran_id,
                            'nilai' => $nilai_item->nilai ?? '-',
                            'capel_id' => $nilai_item->capel_id ?? '-',
                            'capel' => $nilai_item->capel ?? (object) ['nama_capel' => '-'],
                            'tahun_ajaran_id' => $nilai_item->tahun_ajaran_id ?? '-'
                        ];
                    }),
                ];
            });

        // Render tampilan menjadi PDF
        $pdf = Pdf::loadView('walas.cetak_rapor.rapor', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'sekolah' => $sekolah,
            'siswa_absen' => $siswa_absen,
            'siswa_nilai' => $siswa_nilai,
            'pembelajaran' => $pembelajaran,
            'nilai' => $nilai,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'siswa_eskul' => $siswa_eskul
        ]);


        // Unduh PDF
        return $pdf->download($nis  . '_' . $siswa->nama . '_rapor' . '.pdf');
    }



    public function kelasRaporSiswa()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];

        $activeMenu = 'Kelas Siswa';
        $user =  Auth::guard('siswa')->user();
        $kelas = SiswaKelasModel::with('siswa', 'kelas')->where('siswa_id', $user->nis)->get();
        // Ambil tahun ajaran unik
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');

        // Tentukan tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->first();

        // Ambil daftar semester dari model TahunAjarModel, urutkan secara descending
        $semester = TahunAjarModel::distinct('semester')->orderByDesc('semester')->pluck('semester');

        // Tentukan semester terbaru
        $semesterTerbaru = $semester->first(); // Default semester terbaru
        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.index', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu, 'kelas' => $kelas, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru,]);
    }
    public function KelasRaporSiswaCetak($kode_kelas, $nis, $tahun_ajaran_id)
    {

        $breadcrumb = (object) [
            'title' => 'Cetak Rapor',
        ];

        $activeMenu = 'Pembelajaran Siswa';
        $user =  Auth::guard('siswa')->user();
        $kelas = SiswaKelasModel::with('siswa', 'kelas')->where('siswa_id', $user->nis)->get();

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.cetak', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kelas' => $kelas, 'kode_kelas' => $kode_kelas, 'nis' => $nis, 'tahun_ajaran_id' => $tahun_ajaran_id]);
    }
}
