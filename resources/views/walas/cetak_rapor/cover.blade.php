<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
        }

        /* Gaya untuk header */
        .header {
            text-align: center;
            margin-top: 60px;
            margin-bottom: 30px;
        }


        .sekolah {
            text-align: center;
            margin-top: 100px;
            margin-bottom: 30px;
        }

        /* Gaya untuk data diri */
        .data_diri {
            margin-top: 100px;
            display: flex;
            flex-direction: column; /* Elemen diatur dalam kolom */
            align-items: center; /* Memusatkan secara horizontal */
            justify-content: center; /* Memusatkan secara vertikal */
            height: auto;
            text-align: center; /* Memusatkan teks */
        }

        /* Gaya untuk kotak border */
        .border-box {
            border: 1px solid black;
            padding: 10px;
            margin-top: 10px;
            width: 400px;
            font-size: 16px;
            line-height: 1.5;
        }

        /* Gaya untuk footer */
        .footer {
            text-align: center;
            margin-top: 500px;
        }

        /* Aturan untuk cetak */
        @media print {
            @page {
                size: 210mm 330mm; /* Ukuran kertas F4 */
                margin: 20mm; /* Margin default */
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('image/logo1.png') }}" alt="Logo Kemdikbud"  width="400">
            <div class="sekolah">
            <h1>R A P O R</h1>
            <h2>PESERTA DIDIK</h2>
            <h3>SEKOLAH MENENGAH PERTAMA</h3>
            <h3>(SMP)</h3>
        </div>
        </div>

        <!-- Informasi Peserta Didik -->
        <div class="data_diri">
            <strong class="h4">Nama Peserta Didik:</strong>
            <div class="border-box "> <b class="text h4">{{ $siswa->first()->nama }}</b></div>
            <br>
            <strong class="h4">NIS / NISN:</strong>
            <div class="border-box "> <b class="text h4">{{ $siswa->first()->nis }} / {{ $siswa->first()->nisn }}</b></div>
        </div>
        

        <!-- Footer -->
        <div class="footer">
            <h2>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</h2>
            <h2>REPUBLIK INDONESIA</h2>
        </div>
    </div>
</body>
</html>
