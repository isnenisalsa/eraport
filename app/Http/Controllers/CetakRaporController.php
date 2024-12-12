<?php

namespace App\Http\Controllers;

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
            'title' => 'Rapor Kelas',
        ];
        $activeMenu = 'Rapor';
        $user = Auth::user();
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();
        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'activeMenu'));
    }
    public function index($kode_kelas, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'Rapor Kelas',
        ];

        $activeMenu = 'absensi';
        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::with(['guru'])->where('kode_kelas', $kode_kelas)->firstOrFail();
        // Ambil semua siswa yang terdaftar di kelas ini
        $siswa = SiswaKelasModel::with('siswa')
            ->where('kelas_id', $kode_kelas)
            ->get();
        return view('walas.cetak_rapor.cetak', compact('breadcrumb', 'kelas', 'siswa', 'kode_kelas', 'activeMenu', 'tahun_ajaran_id'));
    }
    // public function show($kode_kelas)
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Detail Kelas',
    //     ];
    //     $kelas = KelasModel::with(['guru', 'siswa'])
    //         ->where('kode_kelas', $kode_kelas)
    //         ->firstOrFail();
    //     $siswa = $kelas->siswa; // Relasi siswa harus sudah didefinisikan di KelasModel
    //     return view('cetak.detail', compact('breadcrumb', 'kelas', 'siswa'));
    // }
    public function cover($nis)
    {
        $siswa = SiswaModel::where('nis', $nis)->get();
        return view('walas.cetak_rapor.cover', compact('siswa'));
    }
    public function biodata($nis)
    {
        // Breadcrumb untuk halaman
        // Breadcrumb untuk halaman
        $breadcrumb = (object) [
            'title' => 'Biodata Siswa',
        ];

        $activeMenu = 'cetak-rapor';

        $siswa = SiswaModel::where('nis', $nis)->firstOrFail();

        $sekolah = SekolahModel::all();

        // Mengirimkan data siswa dan sekolah ke view
        return view('walas.cetak_rapor.biodata', compact('siswa', 'sekolah'));
    }

    public function rapor($kode_kelas, $nis, $tahun_ajaran_id)
    {
        $siswa = SiswaModel::where('nis', $nis)->firstOrFail();
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
            $siswa_absen = (object) ['absensi' => '-']; // Tampilkan '-' jika tidak ada absensi
        }

        // Ambil data pembelajaran
        $pembelajaran = PembelajaranModel::where('nama_kelas', $kode_kelas)->get();

        $siswa_nilai = SiswaKelasModel::where('siswa_id', $nis)
            ->whereHas('nilai', function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->where('nilai_rapor', '>', 0); // Lebih besar dari 0
            })
            ->with(['nilai' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id)
                    ->where('nilai_rapor', '>', 0); // Lebih besar dari 0
            }])
            ->first();

        if (!$siswa_nilai) {
            $siswa_nilai = (object) ['nilai' => collect()]; // Mengganti dengan koleksi kosong jika tidak ada nilai
        }
        $siswa_eskul = SiswaKelasModel::where('siswa_id', $nis)
            ->with(['nilaieskul' => function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran_id', $tahun_ajaran_id); // Filter berdasarkan tahun_ajaran_id
            }, 'nilaieskul.eskul']) // Memuat relasi eskul melalui nilaieskul
            ->get();






        // Ambil nilai yang memiliki capel_id, jika tidak ada tampilkan '-'
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

        // Kirim data ke view
        return view('walas.cetak_rapor.rapor', [
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
    }


    public function kelasRaporSiswa()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pembelajaran',
        ];

        $activeMenu = 'Pembelajaran Siswa';
        $user =  Auth::guard('siswa')->user();
        $kelas = SiswaKelasModel::with('siswa', 'kelas')->where('siswa_id', $user->nis)->get();

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kelas' => $kelas]);
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
