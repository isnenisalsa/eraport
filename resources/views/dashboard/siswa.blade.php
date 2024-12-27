@extends('layouts.template')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <!-- Kartu Data Siswa -->
            <div class="col-md-3 mb-2">
                <div class="card text-white bg-gradient-blue h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
                    <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                        <p class="h5">{{ $tbl_kelas }}</p>
                        <h5>Data Kelas</h5>
                    </div>
                    <a href="{{ url('cetak/rapor/siswa') }}" class="card-footer bg-gradient-blue text-center p-2">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endsection
