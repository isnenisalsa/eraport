<?php

namespace App\Http\Controllers;

use App\Models\EskulModel;
use App\Models\EskulSiswaModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\NilaiEskulModel;
use App\Models\SiswaKelasModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EskulController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Eskul',
        ];


        $activeMenu = 'Ekstrakurikuler Admin';
        $eskul = EskulModel::all();
        $guru = GuruModel::all();
        return view('admin.eskul.index', ['breadcrumb' => $breadcrumb, 'eskul' => $eskul, 'guru' => $guru, 'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validateWithBag(

            'tambahBag',
            [
                'nama_eskul' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tempat' => 'required',

            ],
            [
                'nama_eskul.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tempat.required' => 'Tahun ajaran wajib dipilih',

            ]
        );
        // Buat entri baru di tabel kelas
        EskulModel::create([
            'nama_eskul' => $request->nama_eskul,
            'guru_nik' => $request->guru_nik,
            'tempat' => $request->tempat,
        ]);
        return redirect()->route('eskul.index')->with('success', 'data berhasil ditambah');
    }
    public function update(Request $request, $id)
    {
        $request->validateWithBag(

            'editBag',
            [
                'nama_eskul' => 'required|string|max:255',
                'guru_nik' => 'required|exists:guru,nik',
                'tempat' => 'required',

            ],
            [
                'nama_eskul.required' => 'Nama kelas wajib diisi',
                'guru_nik.required' => 'Wali kelas wajib dipilih',
                'guru_nik.exists' => 'Wali kelas tidak valid',
                'tempat.required' => 'Tahun ajaran wajib dipilih',

            ]
        );
        $eskul = EskulModel::find($id);
        // Perbarui data guru dengan data dari form
        $eskul->update([

            'nama_eskul' => $request->input('nama_eskul'),
            'guru_nik' => $request->input('guru_nik'),
            'tempat' => $request->tempat,
        ]);

        return redirect()->route('eskul.index')->with('success', 'Data Kelas berhasil diperbarui');
    }


    public function KelasEskul()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kelas',
        ];


        $activeMenu = 'Ekstrakurikuler';
        $user = Auth::user();

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
        $semesterTerbaru = $semester->sortDesc()->first();


        return view('walas.ekstrakulikuler.kelas', ['breadcrumb' => $breadcrumb, 'tahunAjaran' => $tahunAjaran, 'tahunAjaranTerbaru' => $tahunAjaranTerbaru, 'semester' => $semester, 'semesterTerbaru' => $semesterTerbaru, 'kelas' => $kelas, 'activeMenu' => $activeMenu]);
    }
    public function NilaiEskul($kode_kelas, $tahun_ajaran_id)
    {

        $breadcrumb = (object) [
            'title' => 'Nilai Ekstrakurikuler',
        ];
        $activeMenu = 'Ekstrakurikuler';
        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->first();
        $siswa_kelas = SiswaKelasModel::with('siswa')->where('kelas_id', $kode_kelas)->get();
        $eskul = EskulModel::all();
        $eskuldata = NilaiEskulModel::with('siswa', 'eskul')->where('tahun_ajaran_id', $tahun_ajaran_id)->whereHas('siswa', function ($query) use ($kode_kelas) {
            $query->where('kelas_id', $kode_kelas);
        })
            ->get();;
        return view('walas.ekstrakulikuler.nilai', ['breadcrumb' => $breadcrumb, 'kode_kelas' => $kode_kelas, 'kelas' => $kelas, 'eskul' => $eskul, 'eskuldata' => $eskuldata, 'siswa_kelas' => $siswa_kelas, 'activeMenu' => $activeMenu, 'tahun_ajaran_id' => $tahun_ajaran_id]);
    }
    public function SaveNilai(Request $request, $tahun_ajaran_id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa_kelas,id',
            'eskul_id' => 'required',
            'keterangan' => 'nullable|string|max:255',

        ]);

        NilaiEskulModel::create([
            'siswa_id' => $request->siswa_id,
            'eskul_id' => $request->eskul_id,
            'keterangan' => $request->keterangan,
            'tahun_ajaran_id' => $tahun_ajaran_id
        ]);

        return redirect()->back()->with('success', 'Nilai eskul berhasil disimpan.');
    }
}
