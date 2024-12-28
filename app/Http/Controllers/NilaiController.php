<?php

namespace App\Http\Controllers;

use App\Models\CapaianModel;
use App\Models\NilaiModel;
use App\Models\PembelajaranModel;
use App\Models\SiswaKelasModel;
use App\Models\TahunAjarModel;
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
        $semester = TahunAjarModel::where('id', $tahun_ajaran_id)->pluck('semester')->first();
        $capel = CapaianModel::where('pembelajaran_id', $id)->where('tahun_ajaran_id', $tahun_ajaran_id)->get();
        // Group Capel by Lingkup Materi
        $groupedCapel = $capel->groupBy(function ($item) {
            return $item->lingkup->nama_lingkup_materi; // Kelompokkan berdasarkan nama lingkup materi
        });


        $nilai = NilaiModel::where('pembelajaran_id', $id)->get();
        $breadcrumb = (object)[
            'title' => 'KELOLA NILAI',
        ];
        $activeMenu =  'Data Pembelajaran';

        return view('guru.nilai.index', [
            'groupedCapel' => $groupedCapel,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'pembelajaran' => $pembelajaran,
            'id' => $id,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'nilai' => $nilai,
            'siswa' => $siswa,
            'capel' => $capel,
            'semester' => $semester
        ]);
    }

    public function update(Request $request)
    {
        try {
            // Validasi input
            $request->validate(
                [
                    // Validasi untuk ID pembelajaran
                    'pembelajaran_id' => 'required|exists:pembelajaran,id_pembelajaran',

                    // Validasi untuk siswa
                    'siswa.*.id' => 'required|exists:siswa_kelas,id', // Validasi ID siswa, harus ada di tabel siswa_kelas

                    // Validasi untuk capel
                    'siswa.*.capel' => 'required',
                    'siswa.*.capel.*.id' => 'required|exists:capel,id', // Validasi ID capel, harus ada di tabel capel
                    'siswa.*.capel.*.nilai' => 'required|numeric|between:0,100', // Validasi nilai capel, harus angka dan di antara 0 sampai 100

                    // Validasi untuk nilai UTS
                    'siswa.*.uts' => 'required|numeric|between:0,100', // Validasi nilai UTS, harus angka dan di antara 0 sampai 100

                    // Validasi untuk nilai UAS
                    'siswa.*.uas' => 'required|numeric|between:0,100', // Validasi nilai UAS, harus angka dan di antara 0 sampai 100

                    // Validasi untuk rata-rata tupel (nilai capel)
                    'siswa.*.rata_rata_tupel' => 'nullable|numeric|between:0,100', // Validasi rata-rata tupel, boleh kosong, harus angka dan di antara 0 sampai 100

                    // Validasi untuk rata-rata UTS & UAS
                    'siswa.*.rata_rata_uts_uas' => 'nullable|numeric|between:0,100', // Validasi rata-rata UTS & UAS, boleh kosong, harus angka dan di antara 0 sampai 100

                    // Validasi untuk nilai rapor
                    'siswa.*.nilai_rapor' => 'nullable|numeric|between:0,100', // Validasi nilai rapor, boleh kosong, harus angka dan di antara 0 sampai 100
                ],
                [
                    // Pesan error untuk capel nilai
                    'siswa.*.capel.required' => 'Data capel harus berupa ada.',
                    'siswa.*.capel.*.nilai.required' => 'Nilai capel wajib diisi.',
                    'siswa.*.capel.*.nilai.numeric' => 'Nilai capel hanya boleh diisi dengan angka.',
                    'siswa.*.capel.*.nilai.between' => 'Nilai capel harus berada di antara 0 hingga 100.',

                    // Pesan error untuk UTS
                    'siswa.*.uts.required' => 'Nilai UTS wajib diisi.',
                    'siswa.*.uts.numeric' => 'Nilai UTS hanya boleh diisi dengan angka.',
                    'siswa.*.uts.between' => 'Nilai UTS harus berada di antara 0 hingga 100.',

                    // Pesan error untuk UAS
                    'siswa.*.uas.required' => 'Nilai UAS wajib diisi.',
                    'siswa.*.uas.numeric' => 'Nilai UAS hanya boleh diisi dengan angka.',
                    'siswa.*.uas.between' => 'Nilai UAS harus berada di antara 0 hingga 100.',

                    // Pesan error untuk rata-rata tupel
                    'siswa.*.rata_rata_tupel.numeric' => 'Rata-rata tupel harus berupa angka.',
                    'siswa.*.rata_rata_tupel.between' => 'Rata-rata tupel harus berada di antara 0 hingga 100.',

                    // Pesan error untuk rata-rata UTS & UAS
                    'siswa.*.rata_rata_uts_uas.numeric' => 'Rata-rata UTS & UAS harus berupa angka.',
                    'siswa.*.rata_rata_uts_uas.between' => 'Rata-rata UTS & UAS harus berada di antara 0 hingga 100.',

                    // Pesan error untuk nilai rapor
                    'siswa.*.nilai_rapor.numeric' => 'Nilai rapor harus berupa angka.',
                    'siswa.*.nilai_rapor.between' => 'Nilai rapor harus berada di antara 0 hingga 100.',

                    // Pesan error untuk ID siswa dan capel
                    'siswa.*.id.required' => 'ID siswa wajib diisi.',
                    'siswa.*.id.exists' => 'ID siswa tidak ditemukan dalam data siswa kelas.',
                    'siswa.*.capel.*.id.required' => 'ID capel wajib diisi.',
                    'siswa.*.capel.*.id.exists' => 'ID capel tidak ditemukan.',
                ]
            );


            // Proses data siswa
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

            // Jika tidak ada error, redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangkap error dan kembalikan respons error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
