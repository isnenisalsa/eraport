<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

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
    public function list(Request $request)
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
                return '<a href="' . route('absensi.index', [
                    'kode_kelas' => $row['kode_kelas'],
                    'tahun_ajaran_id' => $row['tahun_ajaran_id']
                ]) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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

        return redirect()->back()->with('success', 'Data Absensi berhasil disimpan.');
    }
}
