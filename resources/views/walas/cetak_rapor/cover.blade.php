<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Header */
        .header {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .header img {
            width: 200px;
        }

        /* Sekolah Title */
        .sekolah {
            margin-bottom: 40px;
        }

        .sekolah h1,
        .sekolah h2,
        .sekolah h3 {
            margin: 5px 0;
        }

        /* Informasi Peserta Didik */
        .data-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            margin-top: 20px;
        }

        .border-box {
            border: 2px solid black;
            padding: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
            width: 100%;
            max-width: 350px;
            font-size: 18px;
            text-transform: uppercase;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
        }

        .footer h2 {
            font-size: 16px;
            margin: 5px 0;
        }

        .footer hr {
            width: 50%;
            border: 1px solid black;
            margin: 30px auto;
        }

        /* Print Styling */
        @media print {
            @page {
                size: 210mm 330mm;
                margin: 20mm;
            }

            body {
                margin: 0;
                padding: 0;
                display: block;
            }

            .container {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                text-align: center;
            }

            .header,
            .sekolah,
            .data-wrapper,
            .footer {
                width: 100%;
                text-align: center;
            }

            .data-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                text-align: center;
            }

            .border-box {
                width: 100%;
                max-width: 350px;
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('image/logo.png') }}" alt="Logo Kemdikbud">
        </div>

        <!-- Title Sekolah -->
        <div class="sekolah" style="size: 100px">
            <h1>R A P O R</h1>
            <h2>PESERTA DIDIK</h2>
            <h3>SMPS IT SIRAJUL HUDA</h3>
            <h3>PELAIHARI</h3>
        </div>

        <!-- Informasi Peserta Didik -->
        <div class="data-wrapper">
            <div>
                <strong class="h4">Nama Peserta Didik:</strong>
                <div class="border-box">{{ $siswa->nama }}</div>
                <strong class="h4" style="margin-top: 100px ">NIS / NISN:</strong>
                <div class="border-box">{{ $siswa->nis }} / {{ $siswa->nisn }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h2 style="margin-top: 150px">KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH</h2>
            <h2>REPUBLIK INDONESIA</h2>
        </div>
    </div>
</body>

</html>
