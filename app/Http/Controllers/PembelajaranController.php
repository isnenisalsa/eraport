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
use Yajra\DataTables\Facades\DataTables;

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
    public function list()
    {
        $pembelajaran = PembelajaranModel::with('mapel', 'kelas', 'guru')->get();

        return DataTables::of($pembelajaran)
            ->addIndexColumn()  // Menambahkan nomor urut
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit' . $row->id_pembelajaran . '">Edit</button>';
            })
            ->make(true);
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
        // Urutkan secara menurun dan ambil tahun ajaran terbaru
        $tahunAjaranTerbaru = $tahunAjaran->sortDesc()->first();
        // Ambil daftar semester dari model TahunAjarModel, urutkan secara descending
        $semester = TahunAjarModel::where('tahun_ajaran', $tahunAjaranTerbaru)->distinct('semester')->orderByDesc('semester')->pluck('semester');
        // Tentukan semester terbaru
        $semesterTerbaru = $semester->sortDesc()->first();

        return view('guru.pembelajaran.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'dataPembelajaran' => $dataPembelajaran, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru,]);
    }


    public function save(Request $request)
    {
        $request->validateWithBag(
            'tambahBag',
            [
                'mata_pelajaran' => [
                    'required',
                    Rule::unique('pembelajaran')->where(function ($query) use ($request) {
                        return $query->where('nama_kelas', $request->nama_kelas);
                    }),
                ],
                'nama_kelas' => 'required',
                'nama_guru' => 'required'
            ],
            [
                'mata_pelajaran.required' => 'Mata Pelajaran tidak boleh kosong',
                'mata_pelajaran.unique' => 'Mata Pelajaran sudah ada di kelas ini',
                'nama_kelas.required' => 'Nama Kelas tidak boleh kosong',
                'nama_guru.required' => 'Nama Guru tidak boleh kosong'
            ]
        );

        // Generate id_pembelajaran otomatis
        $lastPembelajaran = PembelajaranModel::latest('id_pembelajaran')->first();
        if ($lastPembelajaran) {
            // Ambil angka terakhir dari id_pembelajaran dan tambahkan 1
            $lastNumber = (int) substr($lastPembelajaran->id_pembelajaran, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format id_pembelajaran baru
        $idPembelajaran = 'P' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Simpan data ke tabel pembelajaran
        PembelajaranModel::create([
            'id_pembelajaran' => $idPembelajaran,
            'mata_pelajaran' => $request->mata_pelajaran,
            'nama_kelas' => $request->nama_kelas,
            'nama_guru' => $request->nama_guru,
        ]);

        // Tambahkan role ke guru jika diperlukan
        $roleIdToAttach = 2;
        $guruBaru = GuruModel::where('nik', $request->nama_guru)->first();
        if ($guruBaru) {
            $guruBaru->roles()->syncWithoutDetaching([$roleIdToAttach]);
        }

        // Redirect setelah berhasil
        return redirect()->route('pembelajaran')->with('success', 'Data Pembelajaran berhasil disimpan.');
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
        $roleIdToattach = 2;
        // Ambil guru berdasarkan guru_nik
        $guruBaru = GuruModel::where('nik', $request->nama_guru)->first();
        if ($guruBaru) {
            $guruBaru->roles()->syncWithoutDetaching([$roleIdToattach]);
        }

        return redirect()->route('pembelajaran')->with('success', 'Data Pembelajaran berhasil diperbarui');
    }
}
