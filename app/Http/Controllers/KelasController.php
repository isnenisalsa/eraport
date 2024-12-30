<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        $guru = GuruModel::where('status', 'Aktif')->get();
        $tahun = TahunAjarModel::all();

        return view('admin.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'guru' => $guru, 'tahun' => $tahun, 'activeMenu' => $activeMenu]);
    }
    public function list()
    {
        $kelas = KelasModel::with(['guru', 'tahunAjarans'])->get();

        return DataTables::of($kelas)
            ->addIndexColumn()
            ->addColumn('nama_tahun', function ($row) {
                // Mengambil tahun ajaran pertama jika ada
                return $row->tahunAjarans->first() ? $row->tahunAjarans->first()->tahun_ajaran : '-';
            })  // Menambahkan nomor urut
            ->make(true);
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
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');
        // Urutkan secara menurun dan ambil tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->sortDesc()->first();
        return view('walas.kelas.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'activeMenu' => $activeMenu]);
    }
    public function listKelasWalas(Request $request)
    {
        $user = Auth::user();

        // Query data kelas
        $query = KelasModel::with(['guru', 'tahunAjarans'])
            ->withCount(['siswa']) // Menghitung jumlah siswa
            ->where('guru_nik', $user->nik);

        // Filter berdasarkan Tahun Ajaran
        if ($request->has('tahun_ajaran') && $request->tahun_ajaran) {
            $query->whereHas('tahunAjarans', function ($q) use ($request) {
                $q->where('tahun_ajaran', $request->tahun_ajaran);
            });
        }

        // Ambil data
        $kelas = $query->get();

        // Ubah data untuk keperluan DataTables
        $data = $kelas->map(function ($kelas) {
            $tahunAjaranPertama = $kelas->tahunAjarans->first(); // Ambil tahun ajaran pertama
            return [
                'nama_kelas' => $kelas->nama_kelas,
                'guru_nama' => $kelas->guru->nama,
                'jumlah_siswa' => $kelas->siswa_count,
                'tahun_ajaran' => $tahunAjaranPertama ? $tahunAjaranPertama->tahun_ajaran : null,
                'kode_kelas' => $kelas->kode_kelas,
            ];
        });

        // Return data untuk DataTables
        return DataTables::of($data)
            ->addIndexColumn() // Tambahkan nomor urut
            ->addColumn('aksi', function ($row) {
                return '<a href="' . route('siswa_kelas', $row['kode_kelas']) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['aksi']) // Membolehkan HTML di kolom 'aksi'
            ->make(true);
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



        // For debugging purposes, to check the retrieved semester
        return view('walas.nilaiakhir.index', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas,  'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru, 'activeMenu' => $activeMenu]);
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
                return '<a href="' . route('nilai.akhir.index', [
                    'kode_kelas' => $row['kode_kelas'],
                    'tahun_ajaran_id' => $row['tahun_ajaran_id']
                ]) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function save(Request $request)
    {
        // Validasi input
        $request->validateWithBag('tambahBag', [
            'nama_kelas' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    // Jika nilai null, lewati validasi
                    if (is_null($value)) {
                        return;
                    }

                    // Jika $request->tahun_ajaran_id tidak terisi atau bukan array, berikan error
                    if (!is_array($request->tahun_ajaran_id) || empty($request->tahun_ajaran_id)) {
                        $fail('');
                        return;
                    }

                    foreach ($request->tahun_ajaran_id as $tahunAjaranId) {
                        $existingClass = KelasModel::where('nama_kelas', strtoupper($value))
                            ->whereHas('tahunAjarans', function ($query) use ($tahunAjaranId) {
                                $query->where('tahun_ajaran.id', $tahunAjaranId);
                            })
                            ->first();

                        if ($existingClass) {
                            $fail("Nama kelas '$value' sudah digunakan pada tahun ajaran yang dipilih.");
                            break;
                        }
                    }
                }
            ],
            'guru_nik' => 'required|exists:guru,nik',
            'tahun_ajaran_id' => 'required|array',
            'tahun_ajaran_id.*' => 'exists:tahun_ajaran,id',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'guru_nik.required' => 'Wali kelas wajib dipilih',
            'guru_nik.exists' => 'Wali kelas tidak valid',
            'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih',
            'tahun_ajaran_id.*.exists' => 'Tahun ajaran tidak valid',
        ]);

        // Generate kode_kelas otomatis
        $lastKelas = KelasModel::latest('kode_kelas')->first();
        if ($lastKelas) {
            // Ambil angka terakhir dari kode kelas dan tambahkan 1
            $lastNumber = (int) substr($lastKelas->kode_kelas, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format kode kelas baru
        $kodeKelas = 'K' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Buat entri baru di tabel kelas
        $kelas = KelasModel::create([
            'kode_kelas' => $kodeKelas,
            'nama_kelas' => strtoupper($request->nama_kelas),
            'guru_nik' => $request->guru_nik,
        ]);

        // Simpan data ke tabel pivot kelas_tahun_ajaran dengan kode_kelas
        $tahunAjaranData = [];
        foreach ($request->tahun_ajaran_id as $tahunAjaranId) {
            $tahunAjaranData[] = [
                'kelas_kode' => $kodeKelas,
                'tahun_ajaran_id' => $tahunAjaranId,
            ];
        }

        // Simpan data ke tabel pivot
        $kelas->tahunAjarans()->attach($tahunAjaranData);

        // Tambahkan role ke guru
        $roleIdToAttach = 3;
        $guruBaru = GuruModel::where('nik', $request->guru_nik)->first();
        if ($guruBaru) {
            $guruBaru->roles()->syncWithoutDetaching([$roleIdToAttach]);
        }

        // Redirect ke halaman kelas dengan pesan sukses
        return redirect()->route('kelas')->with('success', 'Data Kelas berhasil disimpan.');
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
        // Tambahkan role ke guru
        $roleIdToAttach = 3;
        $guruBaru = GuruModel::where('nik', $request->guru_nik)->first();
        if ($guruBaru) {
            $guruBaru->roles()->syncWithoutDetaching([$roleIdToAttach]);
        }
        return redirect()->route('kelas')->with('success', 'Data Kelas berhasil diperbarui');
    }
}
