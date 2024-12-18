<?php

namespace App\Http\Controllers;

use App\Models\PembelajaranModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PembelajaranController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembelajaran',
        ];

        $activeMenu = 'pembelajaran';

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        $pembelajaran = PembelajaranModel::with('mapel', 'kelas', 'guru')->get();

        // Mengambil data mapel, kelas, dan guru
        $mapel = MapelModel::all();
        $kelas = KelasModel::all();
        $guru = GuruModel::all();

        return view('admin.pembelajaran.index', [
            'breadcrumb' => $breadcrumb,
            'pembelajaran' => $pembelajaran,
            'mapel' => $mapel,  // Mengirim data mapel ke view
            'kelas' => $kelas,  // Mengirim data kelas ke view
            'guru' => $guru,    // Mengirim data guru ke view
            'activeMenu' => $activeMenu
        ]);
    }
    public function indexGuru()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembelajaran',
        ];

        $activeMenu = 'Data Pembelajaran';
        $user = Auth::user();

        // Mengambil semua data pembelajaran dengan relasi mapel, kelas, dan guru
        $dataPembelajaran = PembelajaranModel::where('nama_guru', $user->nik)->get();
        // Contoh: Kirim data ke view
        $tahunAjaran = TahunAjarModel::distinct('tahun_ajaran')->pluck('tahun_ajaran');

        // Tentukan tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->first();

        // Ambil daftar semester dari model TahunAjarModel, urutkan secara descending
        $semester = TahunAjarModel::distinct('semester')->orderByDesc('semester')->pluck('semester');

        // Tentukan semester terbaru
        $semesterTerbaru = $semester->first(); // Default semester terbaru

        return view('guru.pembelajaran.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'dataPembelajaran' => $dataPembelajaran, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru,]);
    }


    public function save(Request $request)
    {

        $request->validateWithBag(
            'tambahBag',
            [
                'id_pembelajaran' => 'required', // Aturan validasi yang benar
                'mata_pelajaran' => [
                    'required',
                    Rule::unique('pembelajaran')->where(function ($query) use ($request) {
                        return $query->where('nama_kelas', $request->nama_kelas);
                    }),
                ],
                'nama_kelas' => 'required',
                'nama_guru' => 'required' // Pastikan 'nama_guru' sesuai dengan kolom yang ada di tabel 'guru'
            ],
            [
                'id_pembelajaran.required' => 'ID Pembelajaran tidak boleh kosong',
                'mata_pelajaran.required' => 'Mata Pelajaran tidak boleh kosong',
                'mata_pelajaran.unique' => 'Mata Pelajaran sudah ada di kelas ini',
                'nama_kelas.required' => 'Nama Kelas tidak boleh kosong',
                'nama_guru.required' => 'Nama Guru tidak boleh kosong'
            ]
        );

        PembelajaranModel::create([
            'id_pembelajaran' => $request->id_pembelajaran,
            'mata_pelajaran' => $request->mata_pelajaran,
            'nama_kelas' => $request->nama_kelas,
            'nama_guru' => $request->nama_guru,
        ]);


        // Ambil guru berdasarkan guru_nik
        $guru = GuruModel::find($request->nama_guru);

        // Tambahkan role ke guru jika belum ada
        if (!$guru->roles()->where('role_id', 2)->exists()) {
            $guru->roles()->attach(2); // Menambahkan role dengan ID 3
        }

        // Redirect setelah berhasil
        return redirect()->route('pembelajaran')->with('success', 'Data Pembelajaran berhasil disimpan');
    }

    public function update(Request $request, $id_pembelajaran)
    {
        $request->validateWithBag(
            'editBag',
            [
                'id_pembelajaran' => 'required',
                'mata_pelajaran' => 'required',
                'nama_kelas' => 'required',
                'nama_guru' => 'required'
            ],
            [
                'id_pembelajaran.required' => 'ID Pembelajaran tidak boleh kosong',
                'mata_pelajaran.required' => 'Mata Pelajaran  tidak boleh kosong',
                'nama_kelas.required' => 'Nama Kelas tidak boleh kosong',
                'nama_guru.required' => 'Nama Guru tidak boleh kosong'
            ]
        );
        $pembelajaran = PembelajaranModel::find($id_pembelajaran);


        // Perbarui data guru dengan data dari form
        $pembelajaran->update([
            'id_pembelajaran' => $request->input('id_pembelajaran'),
            'mata_pelajaran' => $request->input('mata_pelajaran'),
            'nama_kelas' => $request->input('nama_kelas'),
            'nama_guru' => $request->input('nama_guru'),
        ],);
        $guru = GuruModel::find($request->nama_guru);

        $roleIdToDelete = 2;

        // Hapus role jika ada
        $guru->roles()->detach($roleIdToDelete);

        // Tambahkan role baru
        $guru->roles()->attach($roleIdToDelete);

        return redirect()->route('pembelajaran')->with('success', 'Data Pembelajaran berhasil diperbarui');
    }
}
