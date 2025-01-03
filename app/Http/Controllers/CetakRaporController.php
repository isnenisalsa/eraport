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
use Yajra\DataTables\Facades\DataTables;

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
        // Ambil daftar tahun ajaran yang unik
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');

        // Urutkan secara menurun dan ambil tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->sortDesc()->first();

        // Ambil daftar semester dari model TahunAjarModel berdasarkan tahun ajaran terbaru
        $semester = TahunAjarModel::where('tahun_ajaran', $tahunAjaranTerbaru)
            ->distinct()
            ->orderByDesc('semester')
            ->pluck('semester');
        // Tentukan semester (jika kosong, gunakan default)
        if ($semester->isEmpty()) {
            $semester = collect(['Ganjil', 'Genap']); // Default semester
        } else {
            if (!$semester->contains('Genap')) {
                $semester->push('Genap');
            }
        }

        // Tetapkan semester terbaru berdasarkan data yang ada
        $semesterTerbaru = $semester->first(); // Ambil semester pertama dari koleksi



        return view('walas.cetak_rapor.index', compact('breadcrumb', 'kelas', 'activeMenu', 'tahunAjaran', 'tahunAjaranTerbaru', 'semester', 'semesterTerbaru'));
    }
    public function listWalas(Request $request)
    {
        $user = Auth::user();
        // Ambil data kelas dengan relasi dan hitungan siswa
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount('siswa')
            ->where('guru_nik', $user->nik)
            ->get();

        // Map data menjadi flat dengan mempertimbangkan filter
        $data = $kelas->flatMap(function ($kelas) use ($request) {
            return $kelas->tahunAjarans->map(function ($tahunAjaran) use ($kelas, $request) {
                // Filter Tahun Ajaran
                if ($request->has('tahun_ajaran') && $request->tahun_ajaran) {
                    if ($tahunAjaran->tahun_ajaran != $request->tahun_ajaran) {
                        return null;
                    }
                }

                // Filter Semester
                if ($request->has('semester') && $request->semester) {
                    if ($tahunAjaran->semester != $request->semester) {
                        return null;
                    }
                }

                return [
                    'kode_kelas' => $kelas->kode_kelas,
                    'nama_kelas' => $kelas->nama_kelas,
                    'guru_nama' => $kelas->guru->nama,
                    'jumlah_siswa' => $kelas->siswa_count,
                    'tahun_ajaran' => $tahunAjaran->tahun_ajaran,
                    'semester' => $tahunAjaran->semester,
                    'tahun_ajaran_id' => $tahunAjaran->id,
                ];
            })->filter(); // Hapus elemen null
        });

        // Kembalikan data ke DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<a href="' . route('cetak.rapor.index', [
                    'kode_kelas' => $row['kode_kelas'],
                    'tahun_ajaran_id' => $row['tahun_ajaran_id']
                ]) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function index($kode_kelas, $tahun_ajaran_id)
    {
        $breadcrumb = (object) [
            'title' => 'Rapor Kelas',
        ];

        $activeMenu = 'Cetak Rapor';
        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::with(['guru'])->where('kode_kelas', $kode_kelas)->firstOrFail();
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->pluck('semester')->first();
        // Ambil semua siswa yang terdaftar di kelas ini
        $siswa = SiswaKelasModel::with('siswa')
            ->where('kelas_id', $kode_kelas)
            ->get();
        return view('walas.cetak_rapor.cetak', compact('breadcrumb', 'kelas', 'siswa', 'kode_kelas', 'activeMenu', 'tahun_ajaran_id', 'semester'));
    }

    public function cover($nis)
    {
        // Ambil data siswa berdasarkan NIS
        $siswa = SiswaModel::where('nis', $nis)->first();
        // Render view menjadi PDF
        $pdf = Pdf::loadView('walas.cetak_rapor.cover', compact('siswa'));

        // Tampilkan PDF di browser
        return $pdf->download($nis . '_' . $siswa->nama . '_' . 'cover' . '.pdf');

        // Jika ingin langsung download:
        // return $pdf->download('cover_rapor_' . $nis . '.pdf');
    }

    public function biodata($nis, $tahun_ajaran_id)
    {
        // Breadcrumb untuk halaman
        $breadcrumb = (object) [
            'title' => 'Biodata Siswa',
        ];

        $activeMenu = 'cetak Rapor';

        $siswa = SiswaModel::where('nis', $nis)->first();
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->first();
        $sekolah = SekolahModel::all();

        // Membuat view untuk PDF
        $pdf = PDF::loadView('walas.cetak_rapor.biodata', compact('siswa', 'sekolah', 'semester'));

        // Mengirimkan PDF untuk diunduh atau ditampilkan
        return $pdf->download($nis . '_' . $siswa->nama . '_' . 'biodata' . '.pdf'); // Untuk mengunduh
        // return $pdf->stream('biodata_siswa.pdf'); // Untuk menampilkan
    }

    public function rapor($kode_kelas, $nis, $tahun_ajaran_id)
    {
        $siswa = SiswaModel::where('nis', $nis)->first();
        $kelas = KelasModel::with('guru')->get()->where('kode_kelas', $kode_kelas);
        $sekolah = SekolahModel::firstOrFail();
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->first();
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

        $siswa_eskul = SiswaKelasModel::where('siswa_id', $nis)->where('kelas_id', $kode_kelas)
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
            'siswa_eskul' => $siswa_eskul,
            'semester' => $semester
        ]);
        // // Unduh PDF
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
        // Ambil daftar tahun ajaran yang unik
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');

        // Urutkan secara menurun dan ambil tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->sortDesc()->first();

        // Ambil daftar semester dari model TahunAjarModel berdasarkan tahun ajaran terbaru
        $semester = TahunAjarModel::where('tahun_ajaran', $tahunAjaranTerbaru)
            ->distinct()
            ->orderByDesc('semester')
            ->pluck('semester');
        // Tentukan semester (jika kosong, gunakan default)
        if ($semester->isEmpty()) {
            $semester = collect(['Ganjil', 'Genap']); // Default semester
        } else {
            if (!$semester->contains('Genap')) {
                $semester->push('Genap');
            }
        }

        // Tetapkan semester terbaru berdasarkan data yang ada
        $semesterTerbaru = $semester->first(); // Ambil semester pertama dari koleksi




        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.index', ['breadcrumb' => $breadcrumb,  'activeMenu' => $activeMenu, 'kelas' => $kelas, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru,]);
    }
    public function listSiswa(Request $request)
    {
        // Ambil data user siswa yang sedang login
        $user = Auth::guard('siswa')->user();

        // Ambil data kelas dengan relasi yang diperlukan
        $kelas = SiswaKelasModel::with(['kelas.guru', 'kelas.tahunAjarans'])
            ->where('siswa_id', $user->nis)
            ->get();

        // Proses data untuk diolah dan difilter
        $data = $kelas->flatMap(function ($kelasItem) use ($request) {
            // Pastikan ada relasi `tahunAjarans` di kelas
            if (!$kelasItem->kelas->tahunAjarans) {
                return collect(); // Kembalikan collection kosong jika tidak ada data
            }

            return $kelasItem->kelas->tahunAjarans->map(function ($tahunAjaran) use ($kelasItem, $request) {
                // Filter berdasarkan tahun ajaran
                if ($request->filled('tahun_ajaran') && $request->tahun_ajaran != $tahunAjaran->tahun_ajaran) {
                    return null;
                }

                // Filter berdasarkan semester
                if ($request->filled('semester') && $request->semester != $tahunAjaran->semester) {
                    return null;
                }

                return [
                    'siswa_id' => $kelasItem->siswa_id,
                    'kode_kelas' => $kelasItem->kelas->kode_kelas,
                    'nama_kelas' => $kelasItem->kelas->nama_kelas,
                    'guru_nama' => $kelasItem->kelas->guru->nama ?? '-',
                    'tahun_ajaran' => $tahunAjaran->tahun_ajaran,
                    'semester' => $tahunAjaran->semester,
                    'tahun_ajaran_id' => $tahunAjaran->id,
                ];
            })->filter(); // Hapus elemen null
        });

        // Kembalikan data ke DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<a href="' . route('cetak.index.siswa', [
                    'kode_kelas' => $row['kode_kelas'],
                    'nis' => $row['siswa_id'],
                    'tahun_ajaran_id' => $row['tahun_ajaran_id']
                ]) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function KelasRaporSiswaCetak($kode_kelas, $nis, $tahun_ajaran_id)
    {

        $breadcrumb = (object) [
            'title' => 'Cetak Rapor',
        ];
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->pluck('semester')->first();

        $activeMenu = 'Kelas Siswa';
        $kelas = SiswaKelasModel::with(['siswa', 'kelas.tahunAjarans'])
            ->where('siswa_id', $nis)
            ->where('kelas_id', $kode_kelas)
            ->whereHas('kelas.tahunAjarans', function ($query) use ($tahun_ajaran_id) {
                $query->where('tahun_ajaran.id', $tahun_ajaran_id); // Tambahkan prefix tabel
            })
            ->get();
        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        return view('siswa.cetak_rapor.cetak', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'kelas' => $kelas, 'kode_kelas' => $kode_kelas, 'nis' => $nis, 'tahun_ajaran_id' => $tahun_ajaran_id, 'semester' => $semester]);
    }
}
