<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Peserta Didik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        /* Frame foto di kanan bawah */
        .photo-frame {
    position: relative; /* Posisi relatif terhadap elemen induk */
    top: 20px; /* Jarak dari bawah biodata */
    left:300px; /* Jarak dari sisi kiri biodata, untuk memindahkan frame ke kanan sedikit */
    
    width: 100px; /* Lebar frame */
    height: 130px; /* Tinggi frame */
    border: 1px solid #000;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}



        .photo-frame span {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body onload="window.print();">

    <!-- Header -->
    <div class="header">
        <h2>IDENTITAS PESERTA DIDIK</h2>
    </div>

    <!-- Tabel Biodata -->
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
    <br>
    <br>
    <br>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
               
                <p class="card-text" id="date"></p>
            </div>
        </div>
    </div>

    <!-- Frame Foto -->
    <div class="photo-frame">
        <span>Foto Peserta Didik<br>(3x4)</span>
    </div>

</body>
</html>
<script>
    // Mendapatkan tanggal saat ini
    const currentDate = new Date();
    
    // Format tanggal dalam bentuk dd-mm-yyyy
    const formattedDate = currentDate.toLocaleDateString('id-ID');

    // Menampilkan tanggal pada elemen dengan id "date"
    document.getElementById('date').innerText = `Tanggal Sekarang: ${formattedDate}`;
</script>
