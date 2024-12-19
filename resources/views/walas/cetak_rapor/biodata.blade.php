<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Peserta Didik</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
            line-height: 1.4;
            position: relative;
        }

        /* Styling untuk Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        /* Styling tabel biodata */
        table {
            width: 700px;
            /* Tetapkan lebar tetap */
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 14px;
        }

        table td {
            padding: 5px;
        }

        /* Styling untuk tanda tangan dan foto di bawah */
        .footer-container {

            /* Ganti flex dengan block */
            margin-top: 40px;
            width: 100%;
            position: absolute;

            margin-left: 300px;
            /* Tambahkan margin kiri untuk menggeser ke kanan */
        }

        .footer-container .photo-frame {
            width: 90px;
            height: 120px;
            border: 1px solid #000;
            display: inline-block;
            /* Ganti flex dengan inline-block */
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-right: 72px;
            vertical-align: top;
            /* Menyusun elemen ke atas */
        }

        .footer-container .signature {
            margin-top: 10px;
            display: inline-block;
            /* Ganti flex dengan inline-block */
            text-align: left;
            font-size: 14px;
            width: 250px;
            position: relative;
        }

        .signature .date-input {
            font-size: 14px;
            padding: 5px;
            margin-bottom: 10px;
            width: 150px;
        }

        .signature .name {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .signature p {
            margin: 0;
        }

        /* Styling container untuk biodata */
        .biodata-container {
            margin-bottom: 40px;
        }

        /* Styling garis bawah untuk nama dan NIP */
        .underline {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h2>IDENTITAS PESERTA DIDIK</h2>
    </div>

    <!-- Tabel Biodata -->
    <div class="biodata-container">
        <table>
            <tr>
                <td style="width: 35%;">Nama Peserta Didik</td>
                <td>: {{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>NIS / NISN</td>
                <td>: {{ $siswa->nis }} / {{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $siswa->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ $siswa->agama }}</td>
            </tr>
            <tr>
                <td>Pendidikan Sebelumnya</td>
                <td>: {{ $siswa->pendidikan_terakhir }}</td>
            </tr>
            <tr>
                <td>Alamat Peserta Didik</td>
                <td>: {{ $siswa->alamat }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Nama Orang Tua</strong></td>
            </tr>
            <tr>
                <td>Ayah</td>
                <td>: {{ $siswa->nama_ayah }}</td>
            </tr>
            <tr>
                <td>Ibu</td>
                <td>: {{ $siswa->nama_ibu }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Pekerjaan Orang Tua</strong></td>
            </tr>
            <tr>
                <td>Ayah</td>
                <td>: {{ $siswa->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>Ibu</td>
                <td>: {{ $siswa->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Alamat Orang Tua</strong></td>
            </tr>
            <tr>
                <td>Jalan</td>
                <td>: {{ $siswa->jalan }}</td>
            </tr>
            <tr>
                <td>Kelurahan/Desa</td>
                <td>: {{ $siswa->kelurahan }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: {{ $siswa->kecamatan }}</td>
            </tr>
            <tr>
                <td>Kabupaten/Kota</td>
                <td>: {{ $siswa->kota }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>: {{ $siswa->provinsi }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Wali Peserta Didik</strong></td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td>: {{ $siswa->nama_wali }}</td>
            </tr>
            <tr>
                <td>Pekerjaan Wali</td>
                <td>: {{ $siswa->pekerjaan_wali }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon Wali</td>
                <td>: {{ $siswa->no_telp_wali }}</td>
            </tr>
        </table>
    </div>

    <!-- Tanda Tangan Kepala Sekolah dan Foto -->
    <div class="footer-container">
        <!-- Frame Foto (3x4) -->
        <div class="photo-frame">
            <span>Foto Peserta Didik<br>(3x4)</span>
        </div>

        <!-- Tanda Tangan Kepala Sekolah -->
        <div class="signature">
            <p><span>Pelaihari, </span>
                <span>
                    <?php
                    // Mendapatkan tanggal saat ini
                    $daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $monthsOfYear = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    // Mendapatkan tanggal saat ini
                    $currentDate = new DateTime();
                    $dayOfWeek = $daysOfWeek[$currentDate->format('w')];
                    $day = $currentDate->format('d');
                    $month = $monthsOfYear[$currentDate->format('m') - 1];
                    $year = $currentDate->format('Y');
                    
                    // Format tanggal
                    echo $day . ' ' . $month . ' ' . $year;
                    ?>
                </span>
            </p>
            <p><span>Kepala Sekolah</span></p><br><br><br><br>
            <p class="name underline">{{ $sekolah->first()->nama_kepsek }}</p>
            <p class="">{{ $sekolah->first()->nip_kepsek }}</p>
        </div>
    </div>

    <script>
        // Menunggu beberapa detik sebelum mencetak atau mendownload halaman
        setTimeout(function() {

            const monthsOfYear = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            const day = currentDate.getDate();
            const month = monthsOfYear[currentDate.getMonth()];
            const year = currentDate.getFullYear();

            const formattedDate = ` ${day} ${month} ${year}`;
            document.getElementById('formatted-date').textContent = formattedDate;
        }, 100); // Menunggu 100ms sebelum mengeksekusi
    </script>

</body>

</html>
