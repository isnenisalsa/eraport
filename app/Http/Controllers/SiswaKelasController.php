<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\TahunAjarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    public function index($kode_kelas)
    {

        $breadcrumb = (object) [
            'title' => 'Daftar Siswa',
        ];


        $activeMenu = 'Data Kelas';

        // Ambil data kelas berdasarkan kode_kelas
        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->firstOrFail();
        $siswa_kelas = SiswaKelasModel::with('siswa', 'kelas')
            ->where('kelas_id', $kode_kelas)
            ->get();
        $kelas_id = KelasModel::where('kode_kelas', $kode_kelas)->value('kode_kelas');
        $tahunAjaranSekarang = KelasModel::where('kode_kelas', $kode_kelas)
            ->with(['tahunAjarans' => function ($query) {
                $query->orderBy('tahun_ajaran', 'desc'); // Urutkan berdasarkan tahun ajaran terbaru
            }])
            ->first()
            ->tahunAjarans
            ->first(); // Ambil hanya satu (yang terbaru)

        $siswa = SiswaModel::whereNotIn('nis', function ($query) use ($tahunAjaranSekarang) {
            $query->select('siswa_id')
                ->from('siswa_kelas')
                ->join('kelas', 'kelas.kode_kelas', '=', 'siswa_kelas.kelas_id')
                ->join('kelas_tahun_ajaran', 'kelas.kode_kelas', '=', 'kelas_tahun_ajaran.kelas_kode') // Bergabung dengan tabel pivot
                ->where('kelas_tahun_ajaran.tahun_ajaran_id', $tahunAjaranSekarang->id); // Gunakan ID dari $tahunAjaranSekarang
        })->where('status', 'Aktif')->get();


        return view('walas.siswa.index', [
            'breadcrumb' => $breadcrumb,
            'siswa_kelas' => $siswa_kelas,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'kode_kelas' => $kode_kelas,
            'kelas_id' => $kelas_id,
            'activeMenu' => $activeMenu
        ]);
    }

    public function save(Request $request, $kode_kelas)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,nis',
        ]);
        $kelas = KelasModel::where('kode_kelas', $kode_kelas)->value('kode_kelas');

        foreach ($request->siswa_id as $siswa_id) {
            SiswaKelasModel::create([
                'siswa_id' => $siswa_id, // Konversi ke INT jika diperlukan
                'kelas_id' => $kelas,
            ]);
        }


        return redirect()->route('siswa_kelas', $kelas)->with('success', 'Data Berhasil Ditambahkan.');
    }
    public function hapus($nis, $kode_kelas)
    {
        $siswa = SiswaKelasModel::where(['siswa_id' => $nis, 'kelas_id' => $kode_kelas]); // Cari data siswa berdasarkan ID
        $siswa->delete(); // Hapus data
        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
}
