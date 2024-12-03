<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\NilaiModel;
use App\Models\PembelajaranModel;
use App\Models\SiswaKelasModel;
use App\Models\TujuanPembelajaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiAkhirController extends Controller
{
    public function index($id)
    {
        $kelas = KelasModel::where('kode_kelas', $id)->get();
        $siswa_kelas = SiswaKelasModel::where('kelas_id', $id)->get();
        // Ambil data pembelajaran berdasarkan ID
        $pembelajaran = PembelajaranModel::where('nama_kelas', $id)->get();
        $pembelajaranIds = PembelajaranModel::where('nama_kelas', $id)->pluck('id_pembelajaran');

        // Jika tidak ada pembelajaran_id ditemukan, buat koleksi kosong
        if ($pembelajaranIds->isEmpty()) {
            $pembelajaranIds = collect(); // Koleksi kosong
        }

        // Ambil data tupel berdasarkan pembelajaran_id
        $tupel = TujuanPembelajaranModel::whereIn('pembelajaran_id', $pembelajaranIds)->get();

        // Ambil data nilai berdasarkan pembelajaran_id
        $nilai = NilaiModel::whereIn('pembelajaran_id', $pembelajaranIds)
            ->where('nilai_rapor', '!=', 0)
            ->get();
        $breadcrumb = (object)[
            'title' => 'DATA PEMBELAJARAN',
        ];
        $activeMenu = 'pembelajaran';

        return view('walas.nilaiakhir.nilai', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'pembelajaran' => $pembelajaranIds,
            'id' => $id,
            'nilai' => $nilai,
            'tupel' => $tupel,
            'pembelajaran' => $pembelajaran,
            'siswa_kelas' => $siswa_kelas,
            'kelas' => $kelas
        ]);
    }
}