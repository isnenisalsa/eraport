@extends('layouts.template')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <!-- Kartu Data Siswa -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-danger h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
                        <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                            <p class="h5">{{ $dataSiswaCount }}</p>
                            <h5>Data Siswa</h5>
                        </div>
                        <a href="{{ route('siswa') }}" class="card-footer bg-gradient-danger text-center p-2">
                            Lihat detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Kartu Data Guru -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-success h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
                        <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                            <p class="h5">{{ $dataGuruCount }}</p>
                            <h5>Data Guru</h5>
                        </div>
                        <a href="{{ route('guru') }}" class="card-footer bg-gradient-success text-center p-2">
                            Lihat detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif


            <!-- Kartu Data Kelas -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-lightblue h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
                        <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                            <p class="h5">{{ $dataKelasCount }}</p>
                            <h5>Data Kelas</h5>
                        </div>
                        <a href="{{ route('kelas') }}" class="card-footer bg-gradient-lightblue text-center p-2">
                            Lihat detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif


            <!-- Walas -->
            <!-- Kartu Data Kelas -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-lightblue h-auto">
                        <!-- Gunakan h-auto untuk tinggi otomatis -->
                        <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                            <p class="h5">{{ $pembelajaran_walas }}</p>
                            <h5>Data Kelas</h5>
                        </div>
                        <a href="{{ route('kelas.walas') }}" class="card-footer bg-gradient-lightblue text-center p-2">
                            Lihat detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif


            <!-- Kartu Data Pembelajaran -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'guru'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-success h-auto">
                        <!-- Gunakan h-auto untuk tinggi otomatis -->
                        <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                            <p class="h5">{{ $pembelajaran_guru }}</p>
                            <h5>Data Pembelajaran</h5>
                        </div>
                        <a href="{{ route('pembelajaran.guru') }}" class="card-footer bg-gradient-success text-center p-2">
                            Lihat detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif


            <!-- Kartu Profil -->
            <div class="col-md-3 mb-2">
                <div class="card text-white big-counter-ungu h-auto" style="min-height: 120px;">
                    <!-- Atur min-height -->
                    <div class="card-body p-2 d-flex align-items-center justify-content-between">
                        <!-- Flexbox untuk jarak penuh -->
                        <h5 class="mb-0">Data Profile</h5> <!-- Teks di kiri -->
                    </div>
                    <a href="{{ route('profile.show') }}" class="card-footer gradiens-big-counter-ungu text-center p-2">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
