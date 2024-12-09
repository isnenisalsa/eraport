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
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            max-width: 700px;
            font-size: 14px;
        }

        table td {
            padding: 5px;
        }

        /* Styling untuk tanda tangan dan foto di bawah */
        .footer-container {
            display: flex;
            justify-content: right; /* Menyusun elemen secara horizontal di tengah */
            align-items: flex-start; /* Menyusun elemen ke atas */
            margin-top: 40px;
            width: 100%;
        }

        .footer-container .photo-frame {
            width: 90px; /* Lebar frame foto */
            height: 120px; /* Tinggi frame foto */
            border: 1px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-right: 72px; /* Memberikan jarak antara foto dan tanda tangan */
        }

        .footer-container .signature {
            text-align: left; /* Menyusun teks tanda tangan ke tengah */
            font-size: 14px;
            width: 250px;
            position: relative; /* Menjaga elemen berada di tempat yang relatif */
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

        /* Frame Foto (3x4) */
        .photo-frame {
            width: 90px; /* Lebar frame */
            height: 120px; /* Tinggi frame */
            border: 1px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 12px;
            color: #666;
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
<body onload="window.print();">

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
                <td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}</td>
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
                <span id="formatted-date"></span>
            </p>

            <p><span>Kepala Sekolah</span></p><br><br><br>
            <p class="name underline">{{ $sekolah->first()->nama_kepsek }}</p>
            <p class="">{{ $sekolah->first()->nip_kepsek }}</p>
        </div>
    </div>

    <script>
        // Array hari dalam bahasa Indonesia
        const daysOfWeek = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        // Array bulan dalam bahasa Indonesia
        const monthsOfYear = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Mendapatkan tanggal saat ini
        const currentDate = new Date();

        // Mendapatkan hari, tanggal, bulan, dan tahun
        const dayOfWeek = daysOfWeek[currentDate.getDay()];
        const day = currentDate.getDate();
        const month = monthsOfYear[currentDate.getMonth()];
        const year = currentDate.getFullYear();

        // Format tanggal: Hari, Tanggal Bulan Tahun (contoh: Senin, 12 Desember 2024)
        const formattedDate = `${dayOfWeek}, ${day} ${month} ${year}`;

        // Menampilkan tanggal pada elemen dengan id "formatted-date"
        document.getElementById('formatted-date').textContent = formattedDate;
    </script>

</body>
</html>
