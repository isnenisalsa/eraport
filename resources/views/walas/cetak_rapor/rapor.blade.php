<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .kepala-sekolah {
            margin-bottom: 5px;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 20px;
        }

        .rapor-container {
            width: 100%;
            margin: 0 auto;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
            word-break: break-word;
        }

        .header-info td {
            border: none;
            padding: 5px;
        }

        .header-info {
            margin-bottom: 10px;
        }

        .text-center {
            text-align: center;
        }

        .kompetensi {
            font-size: 10px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Adjusted styles for better 2-page fit */
        .page-break-last {
            page-break-before: auto;
        }

        .text-justify-custom {
            text-align: justify;
            /* Rata kanan-kiri */
            text-align-last: center;
            /* Baris terakhir rata tengah */
            word-spacing: -0.5px;
            /* Kurangi jarak antar kata */
            letter-spacing: 0px;
            /* Pertahankan jarak antar huruf */
            line-height: 1.5;
            /* Tinggi baris untuk keterbacaan */
            max-width: 90%;
            /* Batasi lebar konten */
            margin: 0 auto;
            /* Pusatkan konten */
        }
    </style>
    <h1>LAPORAN HASIL BELAJAR</h1>
    <h2>(RAPOR)</h2>
    <table class="header-info" style="border: none">
        <tr>
            <td>Nama Peserta Didik</td>
            <td>: {{ $siswa->nama }}</td>
            <td>Kelas</td>
            <td>: {{ $kelas->first()->nama_kelas }}</td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>: {{ $siswa->nisn }}</td>
            <td>Fase</td>
            <td>: D</td>
        </tr>
        <tr>
            <td>Sekolah</td>
            <td>: {{ $sekolah->nama ?? '-' }}</td>
            <td>Semester</td>
            <td>
                :
                @if ($semester->semester == 'Ganjil')
                    1 (Ganjil)
                @elseif ($semester->semester == 'Genap')
                    2 (Genap)
                @else
                    {{ $semester->semester }} <!-- Display the semester value if it's neither 'ganjil' nor 'genap' -->
                @endif
            </td>

        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $sekolah->alamat ?? '-' }}</td>
            <td>Tahun Pelajaran</td>
            <td>: {{ $semester->tahun_ajaran }}</td>
        </tr>
    </table>
</head>

<body>
    <div class="rapor-container">
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 25%;">Muatan Pelajaran</th>
                    <th class="text-center" style="width: 10%;">Nilai Akhir</th>
                    <th class="text-center" style="width: 60%;">Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($pembelajaran as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->mapel->mata_pelajaran }}</td>
                        <td class="text-center">
                            @php
                                $nilai_rapor = optional(
                                    $siswa_nilai->nilai->firstWhere('pembelajaran_id', $item->id_pembelajaran),
                                )->nilai_rapor;
                            @endphp
                            {{ $nilai_rapor ?? 'Tidak Ada Nilai' }}
                        </td>
                        <td class="text-center text-justify-custom">
                            @php
                                $all_nilai = collect();
                                foreach ($nilai as $n) {
                                    $filtered_nilai = $n['nilai']->filter(function ($value) use (
                                        $item,
                                        $tahun_ajaran_id,
                                    ) {
                                        return $value['pembelajaran_id'] == $item->id_pembelajaran &&
                                            $value['tahun_ajaran_id'] == $tahun_ajaran_id;
                                    });
                                    $all_nilai = $all_nilai->merge($filtered_nilai);
                                }

                                $nilai_tertinggi = $all_nilai->sortByDesc('nilai')->first();
                                $nilai_terendah = $all_nilai->sortBy('nilai')->first();
                            @endphp

                            @php
                                $nama_capaian_tertinggi = '-';
                                $nama_capaian_terendah = '-';

                                if ($nilai_tertinggi && $nilai_tertinggi['nilai'] > 0) {
                                    $nama_capaian_tertinggi = $nilai_tertinggi['capel']->nama_capel ?? '-';
                                }

                                if ($nilai_terendah && $nilai_terendah['nilai'] > 0) {
                                    $nama_capaian_terendah = $nilai_terendah['capel']->nama_capel ?? '-';
                                }
                            @endphp

                            <p class="text-center text-justify-custom">Menunjukkan pemahaman dalam
                                {{ $nama_capaian_tertinggi }}</p>
                            <p class="text-center text-justify-custom">Membutuhkan bimbingan dalam
                                {{ $nama_capaian_terendah }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    <div class="page-break"></div> <!-- Page Break Here -->

    <div class="rapor-container page-break-last">
        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 60%;">Ekstrakurikuler</th>
                    <th class="text-center" style="width: 35%;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($siswa_eskul as $siswa)
                    @php
                        $nilaiCount = $siswa->nilaieskul->count();
                    @endphp
                    @foreach ($siswa->nilaieskul as $nilaieskul)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $nilaieskul->eskul->nama_eskul ?? '-' }}</td>
                            <td class="text-center">{{ $nilaieskul->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                    @if ($nilaiCount < 3)
                        @for ($i = $nilaiCount; $i < 3; $i++)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">-</td>
                            </tr>
                        @endfor
                    @endif
                @endforeach

                @if ($siswa_eskul->isEmpty())
                    @for ($i = 0; $i < 3; $i++)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    @endfor
                @endif
            </tbody>
        </table>

        @if ($semester->semester == 'Genap')
            <table class="table">
                <thead>
                    <th><b>Keputusan</b></th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>Berdasarkan pencapaian seluruh kompetensi, peserta didik dinyatakan:</p>
                            <p><b>Naik/Tinggal kelas*) .......... (..........)</b></p>
                            <p>*) Coret yang tidak perlu</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
        <table style="width: 50%; margin-bottom: 20px; margin-top: 30px">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: center">Ketidakhadiran</th>
                </tr>
                <tr>
                    <th style="text-align: left; width: 70%;">Keterangan</th>
                    <th style="text-align: left; width: 30%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sakit</td>
                    <td>{{ $siswa_absen->absensi->sakit ?? 0 }} Hari</td>
                </tr>
                <tr>
                    <td>Izin</td>
                    <td>{{ $siswa_absen->absensi->izin ?? 0 }} Hari</td>
                </tr>
                <tr>
                    <td>Tanpa Keterangan</td>
                    <td>{{ $siswa_absen->absensi->alfa ?? 0 }} Hari</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <table style="width: 100%; border-collapse: collapse; border: none;">
            <tr>
                <td style="width: 50%;  text-align: center; vertical-align: bottom; border: none;">
                    <div class="d-flex justify-content-center align-items-end">
                        <p>Orang Tua,</p>
                        <br><br><br><br>
                        <span>____________________</span>
                    </div>
                </td>
                <td style="width: 50%; text-align: center; vertical-align: bottom; border: none;">
                    <div class="d-flex justify-content-center align-items-end">
                        <span>Pelaihari,
                            {{ \Carbon\Carbon::parse($semester->tanggal_pembagian_rapor)->translatedFormat('d F Y') }}</span>
                        <p>Wali Kelas</p>
                        <br><br><br><br>
                        <span>{{ $kelas->first()->guru->nama }}</span><br>
                        NIP. <span>{{ $kelas->first()->guru->nip }}</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div style="text-align: center; margin-top: 30px;" class="kepala-sekolah">
        <br>Mengetahui,
        <br>Kepala SMPS IT Sirajul Huda
        <br><br><br><br><br><br>
        <span>{{ $sekolah->nama_kepsek ?? '-' }}</span>
        <br>
        NIP. <span>{{ $sekolah->nip_kepsek ?? '-' }}</span>
    </div>
</body>

</html>
