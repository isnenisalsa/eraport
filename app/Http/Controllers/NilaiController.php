<?php

namespace App\Http\Controllers;

use App\Models\NilaiModel;
use App\Models\PembelajaranModel;
use App\Models\SiswaKelasModel;
use App\Models\TujuanPembelajaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NilaiController extends Controller
{
    public function index($id)
    {
        $pembelajaran = PembelajaranModel::where('id_pembelajaran', $id)->get();
        //siswa
        $pembelejaranId = PembelajaranModel::where('id_pembelajaran', $id)->value('nama_kelas');
        $siswa = SiswaKelasModel::where('kelas_id', $pembelejaranId)->get();
        //tupel
        $tupel = TujuanPembelajaranModel::where('pembelajaran_id', $id)->get();
        $nilai = NilaiModel::where('pembelajaran_id', $id)->get();

        $breadcrumb = (object)[
            'title' => 'DATA PEMBELAJARAN',
        ];
        $activeMenu =  'pembelajaran';

        return view('guru.nilai.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'pembelajaran' => $pembelajaran,
            'id' => $id,
            'nilai' => $nilai,
            'siswa' => $siswa,
            'tupel' => $tupel
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'pembelajaran_id' => 'required',
                'siswa.*.id' => 'required|exists:siswa_kelas,id',
                'siswa.*.tupel.*.id' => 'required|exists:tupel,id',
                'siswa.*.tupel.*.nilai' => 'numeric|between:0,100',
                'siswa.*.uts' => 'numeric|between:0,100',
                'siswa.*.uas' => 'numeric|between:0,100',
                'siswa.*.rata_rata_tupel' => 'numeric|between:0,100',  // Validate rata-rata tupel
                'siswa.*.rata_rata_uts_uas' => 'numeric|between:0,100',  // Validate rata-rata UTS & UAS
                'siswa.*.nilai_rapor' => 'numeric|between:0,100',  // Validate nilai rapor
            ],
            [
                'siswa.*.tupel.*.nilai.numeric' => 'hanya boleh diisi angka',
                'siswa.*.tupel.*.nilai.between' => 'keluar dari range nilai'
            ]
        );

        foreach ($request->input('siswa') as $siswaData) {
            // Proses setiap tupel untuk siswa
            foreach ($siswaData['tupel'] as $tupelData) {
                NilaiModel::updateOrCreate(
                    [
                        'pembelajaran_id' => $request->pembelajaran_id,
                        'siswa_id' => $siswaData['id'],
                        'tupel_id' => $tupelData['id'],
                    ],
                    [
                        'nilai' => $tupelData['nilai'] ?? 0,
                    ]
                );
            }

            // Update atau insert nilai UTS dan UAS untuk siswa
            NilaiModel::updateOrCreate(
                [
                    'pembelajaran_id' => $request->pembelajaran_id,
                    'siswa_id' => $siswaData['id'],
                    'tupel_id' => null, // UTS dan UAS disimpan tanpa tupel_id
                ],
                [
                    'uts' => $siswaData['uts'] ?? 0,
                    'uas' => $siswaData['uas'] ?? 0,
                ]
            );

            // Save the averages (rata-rata tupel, rata-rata UTS & UAS, nilai rapor)
            NilaiModel::updateOrCreate(
                [
                    'pembelajaran_id' => $request->pembelajaran_id,
                    'siswa_id' => $siswaData['id'],
                    'tupel_id' => null, // Save these values without tupel_id
                ],
                [
                    'rata_rata_tupel' => $siswaData['rata_rata_tupel'] ?? 0,
                    'rata_rata_uts_uas' => $siswaData['rata_rata_uts_uas'] ?? 0,
                    'nilai_rapor' => $siswaData['nilai_rapor'] ?? 0,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
