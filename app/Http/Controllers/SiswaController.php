<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleIds = $user->roles->pluck('id')->toArray();

            // Redirect berdasarkan role_id
            if (in_array(1, $roleIds)) {
                $breadcrumb = (object) [
                    'title' => 'Daftar Siswa',
                ];
                $activeMenu = 'siswa';
                $siswa = SiswaModel::all();

                return view('admin.siswa.index', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
            
            } else {
                return redirect('login')->withErrors(['access_denied' => 'Akses ditolak. Role Anda tidak dikenali.']);
            }
        } 
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Siswa',
        ];


        $activeMenu = 'siswa';
        $siswa = SiswaModel::all();

        return view('admin.siswa.create', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|digits:6|unique:siswa,nis',
            'nisn' => 'required|numeric|digits:10',
            'status' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'nama_ayah',
            'pekerjaan_ayah',
            'no_telp_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'no_telp_ibu',
            'nama_wali',
            'pekerjaan_wali',
            'no_telp_wali',
            'terms',
        ], [
            
            'terms.required' => 'wajib di centang'

        ]);
        $username = strtolower(str_replace(' ', '_', $request->nama)); // Mengganti spasi dengan underscore
        $password = Hash::make(strtolower(str_replace(' ', '_', $request->alamat))); // Menggunakan nomor telepon sebagai password yang di-hash
        SiswaModel::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'status' => $request->status,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'no_telp_ayah' => $request->no_telp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_telp_ibu' => $request->no_telp_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'no_telp_wali' => $request->no_telp_wali,

        ]);

        return redirect()->route('siswa');
    }

    public function edit($nis)
    {
        $breadcrumb = (object) [
            'title' => 'Edit siswa',
        ];

        $activeMenu = 'siswa';
        $siswa = SiswaModel::where('nis', $nis)->first();



        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.siswa.update', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $nis)
    {
        // Validasi input
        $request->validate([
           'nis' => 'required|numeric|digits:6',
    'nisn' => 'required|numeric|digits:10',
    'status' => 'required|string',
    'nama' => 'required|string|max:255',
    'jenis_kelamin' => 'required|string',
    'tempat_lahir' => 'required|string|max:255',
    'tanggal_lahir' => 'required|date',
    'alamat' => 'required|string|max:255',
    'nama_ayah' => 'nullable|string|max:255',
    'pekerjaan_ayah' => 'nullable|string|max:255',
    'no_telp_ayah' => 'nullable|string|max:15',
    'nama_ibu' => 'nullable|string|max:255',
    'pekerjaan_ibu' => 'nullable|string|max:255',
    'no_telp_ibu' => 'nullable|string|max:15',
    'nama_wali' => 'nullable|string|max:255',
    'pekerjaan_wali' => 'nullable|string|max:255',
    'no_telp_wali' => 'nullable|string|max:15',
    'terms' => 'nullable|boolean',
        ]);
        $siswa = SiswaModel::findOrFail($nis);

        // Perbarui data guru dengan data dari form
        $siswa->update([
            'nis' => $request->input('nis'),
            'nisn' => $request->input('nisn'),
            'status' => $request->input('status'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nama_ayah' => $request->input('nama_ayah'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'no_telp_ayah' => $request->input('no_telp_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
            'no_telp_ibu' => $request->input('no_telp_ibu'),
            'nama_wali' => $request->input('nama_wali'),
            'pekerjaan_wali' => $request->input('pekerjaan_wali'),
            'no_telp_wali' => $request->input('no_telp_wali'),
            'terms' => $request->input('terms'),
        ]);

        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('siswa')->with('success', 'Data siswa berhasil diperbarui');
    }


}