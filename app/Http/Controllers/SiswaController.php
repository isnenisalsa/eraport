<?php

namespace App\Http\Controllers;

use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Siswa',
        ];
        $activeMenu = 'siswa';
        $siswa = SiswaModel::all();

        return view('admin.siswa.index', ['breadcrumb' => $breadcrumb, 'siswa' => $siswa, 'activeMenu' => $activeMenu]);
    }
    public function list()
    {
        $siswa = SiswaModel::select([
            'nis',
            'nisn',
            'nama',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'status'
        ])->get();

        return DataTables::of($siswa)
            ->addIndexColumn() // Tambahkan nomor urut
            ->rawColumns(['aksi']) // Pastikan kolom "aksi" tidak di-escape
            ->make(true);
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
            'nis' => 'required|numeric|unique:siswa,nis',
            'nisn' => 'required|regex:/^[0-9\-]+$/',
            'status' => 'nullable',
            'nama' => 'required',
            'pendidikan_terakhir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'nullable|email',
            'alamat' => 'required',
            'jalan' => 'nullable',
            'kelurahan' => 'nullable',
            'kecamatan' => 'nullable',
            'kota' => 'nullable',
            'provinsi' => 'nullable',
            'nama_ayah' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'no_telp_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'no_telp_ibu' => 'nullable',
            'nama_wali' => 'nullable',
            'pekerjaan_wali' => 'nullable',
            'no_telp_wali' => 'nullable',
            'alamat_wali' => 'nullable',
            'terms' => 'required',
        ], [
            'nis.required' => 'NIS tidak boleh kosong',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.unique' => 'NIS tidak boleh sama',
            'nisn.required' => 'NISN tidak boleh kosong, jika siswa tidak memiliki NISN isi dengan (-)',
            'nisn.regex' => 'NISN harus berupa angka',
            'nama.required' => 'Nama tidak boleh kosong',
            'pendidikan_terakhir.required' => 'Pendidikan sebelumnya tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'terms.required' => 'Wajib di centang',
            'email.email' => 'format tidak valid',

        ]);
        $username = strtolower(str_replace(' ', '_', $request->nama)); // Mengganti spasi dengan underscore
        $password = Hash::make(strtolower(str_replace(' ', '_', $request->alamat))); // Menggunakan nomor telepon sebagai password yang di-hash
        $status = $request->status ?? 'Aktif'; //
        SiswaModel::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'status' => $status,
            'nama' => $request->nama,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jalan' => $request->jalan,  // Pastikan 'jalan' disimpan
            'kelurahan' => $request->kelurahan,  // Pastikan 'kelurahan' disimpan
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,  // Pastikan 'kota' disimpan
            'provinsi' => $request->provinsi,  // Pastikan 'provinsi' disimpan
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'no_telp_ayah' => $request->no_telp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_telp_ibu' => $request->no_telp_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'no_telp_wali' => $request->no_telp_wali,
            'alamat_wali' => $request->alamat_wali,
            'email' => $request->email,
            'username' => $username,
            'password' => $password,


        ]);

        return redirect()->route('siswa')->with('success', 'Data siswa berhasil disimpan');
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
            'nis' => 'required|numeric',
            'nisn' => 'required|regex:/^[0-9\-]+$/',
            'status' => 'required|string',
            'nama' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'email' => 'nullable|email',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jalan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_telp_ayah' => 'nullable|string|max:15',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_telp_ibu' => 'nullable|string|max:15',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'no_telp_wali' => 'nullable|string|max:15',
            'alamat_wali' => 'nullable|string|max:255',
            'terms' => 'required|accepted',
        ], [
            'nis.required' => 'NIS tidak boleh kosong',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.unique' => 'NIS tidak boleh sama',
            'nisn.required' => 'NISN tidak boleh kosong, jika siswa tidak memiliki NISN isi dengan (-)',
            'nisn.regex' => 'NISN harus berupa angka',
            'nama.required' => 'Nama tidak boleh kosong',
            'pendidikan_terakhir.required' => 'Pendidikan sebelumnya tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'email.email' => 'format tidak valid',
            'terms.required' => 'Wajib dicentang'
        ]);
        $siswa = SiswaModel::findOrFail($nis);

        // Perbarui data guru dengan data dari form
        $siswa->update([
            'nis' => $request->input('nis'),
            'nisn' => $request->input('nisn'),
            'status' => $request->input('status'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'agama' => $request->input('agama'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'jalan' => $request->input('jalan'),
            'kelurahan' => $request->input('kelurahan'),
            'kecamatan' => $request->input('kecamatan'),
            'kota' => $request->input('kota'),
            'provinsi' => $request->input('provinsi'),
            'nama_ayah' => $request->input('nama_ayah'),
            'pekerjaan_ayah' => $request->input('pekerjaan_ayah'),
            'no_telp_ayah' => $request->input('no_telp_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'pekerjaan_ibu' => $request->input('pekerjaan_ibu'),
            'no_telp_ibu' => $request->input('no_telp_ibu'),
            'nama_wali' => $request->input('nama_wali'),
            'pekerjaan_wali' => $request->input('pekerjaan_wali'),
            'no_telp_wali' => $request->input('no_telp_wali'),
            'alamat_wali' => $request->input('alamat_wali'),
            'terms' => $request->input('terms'),
        ]);

        // Redirect ke halaman yang sesuai setelah berhasil update
        return redirect()->route('siswa')->with('success', 'Data siswa berhasil diperbarui');
    }
}
