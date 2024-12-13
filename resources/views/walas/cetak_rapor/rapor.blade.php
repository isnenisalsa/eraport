<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
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
            /* Membungkus kata panjang */
            word-break: break-word;
            /* Memaksa pemutusan kata jika terlalu panjang */
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

        /* Aturan untuk print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            #custom-date {
        border: none;
        background: none;
    }
            .rapor-container {
                margin: 0;
                padding: 0;
            }

            h1,
            h2 {
                font-size: 14px;
            }

            table {
                font-size: 10px;
            }

            /* Hilangkan elemen non-cetak (jika ada) */
            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="rapor-container">
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
                <td>: {{ $sekolah->nama }}</td>
                <td>Semester</td>
                <td>
                    @if ($tahun_ajaran_id == 1)
                        : {{ $tahun_ajaran_id }} Ganjil
                    @elseif ($tahun_ajaran_id == 2)
                        : {{ $tahun_ajaran_id }} Genap
                    @else
                        {{ $tahun_ajaran_id }} (Satu) <!-- Menampilkan $tahun_ajaran_id jika tidak 1 atau 2 -->
                    @endif
                </td>

            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $sekolah->alamat }}</td>
                <td>Tahun Pelajaran</td>
                <td>: 2023/2024</td>
            </tr>
        </table>

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
                @php $no = 1 @endphp
                @foreach ($pembelajaran as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $item->mapel->mata_pelajaran }}</td>
                        <td class="text-center">
                            @php
                                $nilai_rapor = optional(
                                    $siswa_nilai->nilai->firstWhere('pembelajaran_id', $item->id_pembelajaran),
                                )->nilai_rapor;
                            @endphp
                            {{ $nilai_rapor ?? 'Tidak Ada Nilai' }}
                        </td>
                        <td class="text-center">
                            @php
                                // Menggabungkan nilai yang relevan berdasarkan pembelajaran_id dan tahun_ajaran_id
                                $all_nilai = collect();
                                foreach ($nilai as $n) {
                                    $filtered_nilai = $n['nilai']->filter(function ($value) use (
                                        $item,
                                        $tahun_ajaran_id,
                                    ) {
                                        return $value['pembelajaran_id'] == $item->id_pembelajaran &&
                                            $value['tahun_ajaran_id'] == $tahun_ajaran_id; // Filter berdasarkan tahun_ajaran_id
                                    });
                                    $all_nilai = $all_nilai->merge($filtered_nilai);
                                }

                                // Mencari nilai tertinggi dan terendah
                                $nilai_tertinggi = $all_nilai->sortByDesc('nilai')->first();
                                $nilai_terendah = $all_nilai->sortBy('nilai')->first();
                            @endphp

                            @php
                                // Cek jika nilai tertinggi dan terendah lebih besar dari 0
                                $nama_capaian_tertinggi = '-';
                                $nama_capaian_terendah = '-';

                                if ($nilai_tertinggi && $nilai_tertinggi['nilai'] > 0) {
                                    $nama_capaian_tertinggi = $nilai_tertinggi['capel']->nama_capel ?? '-';
                                }

                                if ($nilai_terendah && $nilai_terendah['nilai'] > 0) {
                                    $nama_capaian_terendah = $nilai_terendah['capel']->nama_capel ?? '-';
                                }
                            @endphp

                            Menunjukkan pemahaman dalam {{ $nama_capaian_tertinggi }}
                            <br>
                            membutuhkan bimbingan dalam {{ $nama_capaian_terendah }}
                        </td>
                    </tr>
                @endforeach






            </tbody>
        </table>
        <!-- Bagian Ekstrakurikuler dan Ketidakhadiran -->
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
                <?php $no = 1; ?>
                @foreach ($siswa_eskul as $siswa)
                    @forelse ($siswa->nilaieskul as $nilaieskul)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $nilaieskul->eskul->nama_eskul ?? '-' }}</td>
                            <td class="text-center">{{ $nilaieskul->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <!-- Jika tidak ada data nilaieskul untuk siswa -->
                        <?php $no = 1; ?>
                        @foreach ($siswa_eskul as $siswa)
                            @forelse ($siswa->nilaieskul as $nilaieskul)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">{{ $nilaieskul->eskul->nama_eskul ?? '-' }}</td>
                                    <td class="text-center">{{ $nilaieskul->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <!-- Jika tidak ada data nilaieskul untuk siswa -->
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                    </tr>
                                @endfor
                            @endforelse
                        @endforeach

                        <!-- Jika siswa_eskul kosong, tampilkan 3 baris kosong -->
                        @if ($siswa_eskul->isEmpty())
                            @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                </tr>
                            @endfor
                        @endif
                    @endforelse
                @endforeach


            </tbody>
        </table>
        <table style="width: 50%; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th colspan="3" style="text-align: center">Ketidakhadiran</th>
                </tr>
            </thead>

            <thead>
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

        <!-- Bagian Tanda Tangan -->
        <!-- Bagian Tanda Tangan -->
<!-- Bagian Tanda Tangan -->
<div style="margin-top: 40px; text-align: center;">
    <!-- Baris Orang Tua dan Wali Kelas -->
    <div style="width: 100%; display: flex; justify-content: space-around; align-items: flex-start; margin-bottom: 40px;">
        <!-- Tanda tangan Orang Tua -->
        <div style="text-align: center;">
            <br>
            Orang Tua,
            <br><br><br><br><br>
            <span>____________________</span>
        </div>

        <!-- Tanda tangan Wali Kelas -->
        <div style="text-align: center;">
            <!-- Tanggal tanda tangan -->
            <label for="formatted-date"></label>
            <span id="formatted-date"></span>
            <br>Wali Kelas
            <br><br><br><br>
            <span>{{ $kelas->first()->guru->nama }}</span> <!-- Tampilkan nama Wali Kelas -->
            <br>
            NIP. <span>{{ $kelas->first()->guru->nip }}</span>
        </div>
    </div>

    <!-- Baris Kepala Sekolah -->
    <div style="text-align: center; margin-top: 40px;">
        <br>Mengetahui,
        <br>Kepala Sekolah
        <br><br><br><br>
        <span>{{ $sekolah->nama_kepsek }}</span>
        <br>
        NIP. <span>{{ $sekolah->nip_kepsek }}</span>
    </div>
</div>

<!-- Input untuk memilih tanggal (Hanya muncul di layar, tidak saat print) -->
<div style="text-align: center; margin-top: 20px;" class="no-print">
    <label for="custom-date">Pilih Tanggal:</label>
    <input type="date" id="custom-date" name="custom-date" value="">
</div>

<!-- Tombol untuk Print -->
<button class="no-print" onclick="window.print()" style="margin-top: 20px;">Cetak Rapor</button>

<script>
    // Array bulan dalam bahasa Indonesia
    const monthsOfYear = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const customDateInput = document.getElementById("custom-date");

    // Atur default tanggal ke hari ini
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");
    customDateInput.value = `${year}-${month}-${day}`;

    // Menambahkan event listener untuk mencetak tanggal yang dipilih
    customDateInput.addEventListener("change", () => {
        const selectedDate = new Date(customDateInput.value);
        const formattedDate = `${selectedDate.getDate()} ${monthsOfYear[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;
        document.getElementById("formatted-date").textContent = formattedDate;
    });

    // Update teks awal dengan format baru
    const formattedDate = `${day} ${monthsOfYear[currentDate.getMonth()]} ${year}`;
    document.getElementById("formatted-date").textContent = formattedDate;
</script>

<!-- CSS untuk menyembunyikan elemen saat print -->
<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>


</body>

</html>
