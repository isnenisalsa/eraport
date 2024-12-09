<?php

namespace App\Http\Controllers;

use App\Models\EskulModel;
use App\Models\EskulSiswaModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\NilaiEskulModel;
use App\Models\SiswaKelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EskulController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Ekstrakulikuler',
        ];


        $activeMenu = 'Eskul';
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

        // Ambil guru berdasarkan guru_nik
        $guru = GuruModel::find($request->guru_nik);
        $roleIdToattach = 4;

        // Tambahkan role baru
        $guru->roles()->attach($roleIdToattach);

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
            'title' => 'Daftar kelas',
        ];


        $activeMenu = 'kelas';
        $user = Auth::user();

        $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
            ->withCount(['siswa'])
            ->where('guru_nik', $user->nik)
            ->get();

        return view('walas.ekstrakulikuler.kelas', ['breadcrumb' => $breadcrumb, 'kelas' => $kelas, 'activeMenu' => $activeMenu]);
    }
    public function NilaiEskul($id)
    {
        $breadcrumb = (object) [
            'title' => 'Nilai Ekstrakulikuler',
        ];
        $activeMenu = 'nilai';
        
        $siswa_kelas = SiswaKelasModel::with('siswa')->where('kelas_id', $id)->get();
        
        $eskul = EskulModel::all();
        $user = Auth::user();
        
    $kelas = KelasModel::with(['guru', 'tahun_ajarans'])
    ->withCount(['siswa'])
    ->where('guru_nik', $user->nik)
     // Pastikan hanya kelas yang relevan
    ->first(); // Ambil satu data

        $eskuldata = NilaiEskulModel::with('siswa', 'eskul')->whereHas('siswa', function ($query) use ($id) {
            $query->where('kelas_id', $id);
        })
            ->get();;
            
        return view('walas.ekstrakulikuler.nilai', ['breadcrumb' => $breadcrumb, 'id' => $id, 'eskul' => $eskul, 'eskuldata' => $eskuldata, 'siswa_kelas' => $siswa_kelas, 'activeMenu' => $activeMenu, 'kelas' => $kelas]);
    }
    public function SaveNilai(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa_kelas,id', 
            'eskul_id' => 'required',
            'keterangan' => 'nullable|string|max:255',
        ]);

        NilaiEskulModel::create([
            'siswa_id' => $request->siswa_id,
            'eskul_id' => $request->eskul_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Nilai eskul berhasil disimpan.');
    }
}
