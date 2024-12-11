<?php

namespace App\Http\Controllers;

use App\Models\CapaianModel;
use App\Models\NilaiModel;
use App\Models\PembelajaranModel;
use App\Models\SiswaKelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NilaiController extends Controller
{
    public function index($id, $tahun_ajaran_id)
    {
        $pembelajaran = PembelajaranModel::where('id_pembelajaran', $id)->get();
        //siswa
        $pembelejaranId = PembelajaranModel::where('id_pembelajaran', $id)->value('nama_kelas');
        $siswa = SiswaKelasModel::where('kelas_id', $pembelejaranId)->get();
        //capel
        $capel = CapaianModel::where('pembelajaran_id', $id)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
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
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'nilai' => $nilai,
            'siswa' => $siswa,
            'capel' => $capel
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'pembelajaran_id' => 'required',
                'siswa.*.id' => 'required|exists:siswa_kelas,id',
                'siswa.*.capel.*.id' => 'required|exists:capel,id',
                'siswa.*.capel.*.nilai' => 'numeric|between:0,100',
                'siswa.*.uts' => 'numeric|between:0,100',
                'siswa.*.uas' => 'numeric|between:0,100',
                'siswa.*.rata_rata_tupel' => 'numeric|between:0,100',  // Validate rata-rata capel
                'siswa.*.rata_rata_uts_uas' => 'numeric|between:0,100',  // Validate rata-rata UTS & UAS
                'siswa.*.nilai_rapor' => 'numeric|between:0,100',  // Validate nilai rapor
            ],
            [
                'siswa.*.capel.*.nilai.numeric' => 'hanya boleh diisi angka',
                'siswa.*.capel.*.nilai.between' => 'keluar dari range nilai'
            ]
        );

        foreach ($request->input('siswa') as $siswaData) {
            // Proses setiap capel untuk siswa
            foreach ($siswaData['capel'] as $capelItem) {
                NilaiModel::updateOrCreate(
                    [
                        'pembelajaran_id' => $request->pembelajaran_id,
                        'tahun_ajaran_id' => $request->tahun_ajaran_id,
                        'siswa_id' => $siswaData['id'],
                        'capel_id' => $capelItem['id'],
                    ],
                    [
                        'nilai' => $capelItem['nilai'] ?? 0,
                    ]
                );
            }

            // Update atau insert nilai UTS dan UAS untuk siswa
            NilaiModel::updateOrCreate(
                [
                    'pembelajaran_id' => $request->pembelajaran_id,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'siswa_id' => $siswaData['id'],
                    'capel_id' => null, // UTS dan UAS disimpan tanpa capel_id
                ],
                [
                    'uts' => $siswaData['uts'] ?? 0,
                    'uas' => $siswaData['uas'] ?? 0,
                ]
            );

            // Save the averages (rata-rata capel, rata-rata UTS & UAS, nilai rapor)
            NilaiModel::updateOrCreate(
                [
                    'pembelajaran_id' => $request->pembelajaran_id,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'siswa_id' => $siswaData['id'],
                    'capel_id' => null, // Save these values without capel_id
                ],
                [
                    'rata_rata_capel' => $siswaData['rata_rata_capel'] ?? 0,
                    'rata_rata_uts_uas' => $siswaData['rata_rata_uts_uas'] ?? 0,
                    'nilai_rapor' => $siswaData['nilai_rapor'] ?? 0,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
