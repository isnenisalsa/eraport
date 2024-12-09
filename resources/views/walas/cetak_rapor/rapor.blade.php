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

        h1, h2, h3 {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
    padding: 8px;
    text-align: left;
    vertical-align: top;
    word-wrap: break-word; /* Membungkus kata panjang */
    word-break: break-word; /* Memaksa pemutusan kata jika terlalu panjang */
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

            .rapor-container {
                margin: 0;
                padding: 0;
            }

            h1, h2 {
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
                <td>: {{ $kelas->first()->nama_kelas}}</td>
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
                <td>: I (Satu)</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $sekolah->alamat }}</td>
                <td>Tahun Pelajaran</td>
                <td>: 2023/2024</td>
            </tr>
        </table>

        <table >
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 25%;">Muatan Pelajaran</th>
                    <th class="text-center" style="width: 10%;">Nilai Akhir</th>
                    <th class="text-center" style="width: 60%;">Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Pendidikan Agama Islam</td>
                    <td class="text-center">77</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan pemahaman dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Pendidikan Pancasila dan Kewarganegaraan</td>
                    <td class="text-center">75</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Bahasa Indonesia</td>
                    <td class="text-center">73</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Matematika</td>
                    <td class="text-center">73</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>IPA</td>
                    <td class="text-center">73</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>IPS</td>
                    <td class="text-center">73</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Bahasa Inggris</td>
                    <td class="text-center">73</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan bimbingan dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th class="text-center" style="width: 25%;">Muatan Pelajaran</th>
                    <th class="text-center" style="width: 10%;">Nilai Akhir</th>
                    <th class="text-center" style="width: 60%;">Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Penjaskes</td>
                    <td class="text-center">77</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan pemahaman dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Prakarya</td>
                    <td class="text-center">77</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan pemahaman dalam... ppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp(sesuaikan dengan kompetensi)
                    </td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Muatan Lokal</td>
                    <td class="text-center">77</td>
                    <td class="kompetensi">
                        qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq
                    </td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Informatika</td>
                    <td class="text-center">77</td>
                    <td class="kompetensi">
                        Ahmad Rijal membutuhkan pemahaman dalam... (sesuaikan dengan kompetensi)
                    </td>
                </tr>
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
            <tr>
                <td class="text-center">1</td>
                <td>-</td>
                <td class="text-center">-</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>-</td>
                <td class="text-center">-</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>-</td>
                <td class="text-center">-</td>
            </tr>
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
                <td>0 hari</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>3 hari</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td>5 hari</td>
            </tr>
        </tbody>
    </table>

   <!-- Bagian Tanda Tangan -->
<div style="margin-top: 40px; text-align: center; display: flex; flex-direction: column; align-items: center;">
    <!-- Baris Orang Tua dan Wali Kelas -->
    <div style="width: 100%; display: flex; justify-content: space-around; margin-bottom: 40px;">
        <div style="text-align: center;">
            Orang Tua,
            <br><br><br><br>
            <span>____________________</span>
        </div>
        <div style="text-align: center; margin-top: 50px;">
            <!-- Tanggal tanda tangan -->
            23 Desember 2023
            <br>Wali Kelas,
            <br><br><br><br>
            <br>{{ $kelas->first()->guru->nama }} <!-- Tampilkan NIK Wali Kelas -->
            <br>
            NIP. <span>{{ $kelas->first()->guru->nip}}</span>
            
        </div>
    </div>
    <!-- Baris Kepala Sekolah -->
    <div style="text-align: center; margin-top: 40px;">
        23 Desember 2023
        <br>Kepala Sekolah,
        <br><br><br><br>
        <span>{{ $sekolah->nama_kepsek }}</span>
        <br>
        NIP. <span>{{ $sekolah->nip_kepsek }}</span>
    </div>
</div>

    

    <!-- Tombol untuk Print -->
    <button class="no-print" onclick="window.print()" style="margin-top: 20px;">Cetak Rapor</button>
    <!-- Tambahkan tombol di dalam <body> -->

</div>


</body>
</html>
