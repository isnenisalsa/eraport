@extends('layouts.template')
@section('content')
<div class="container mt-2">
    <div class="row">
        <!-- Kartu Data Siswa -->
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
    
        <!-- Kartu Data Guru -->
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

        <!-- Kartu Data Tahun Pelajaran -->
        <div class="col-md-3 mb-2">
            <div class="card text-white pace-big-counter-orange h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
            <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                <p class="h5">{{ $dataTahunAjaranCount }}</p>
                <h5>Data Tahun Pelajaran</h5>
            </div>
            <a href="{{ route('tahun_ajaran') }}" class="card-footer space-big-counter-orange text-center p-2">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

        <!-- Kartu Data Kelas -->
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

        <!-- Kartu Data Kelas -->
        <div class="col-md-3 mb-2">
            <div class="card text-white bg-navy h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
            <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                <p class="h5">{{ $dataMapelCount }}</p>
                <h5>Data Mapel</h5>
            </div>
            <a href="{{ route('mapel') }}" class="card-footer bg-gradient-navy text-center p-2">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

        <!-- Kartu Data Pembelajaran -->
        <div class="col-md-3 mb-2">
            <div class="card text-white pace-big-counter-biru-tua h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
            <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                <p class="h5">{{ $dataPembelajaranCount }}</p>
                <h5>Data Pembelajaran</h5>
            </div>
            <a href="{{ route('pembelajaran') }}" class="card-footer space-big-counter-biru-tua text-center p-2">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

                <!-- Kartu Data Ekstrakulikuler -->
                <div class="col-md-3 mb-2">
                    <div class="card text-white pace-big-counter-hijau-toska  h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
                    <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                        <p class="h5">{{ $dataEskulCount }}</p>
                        <h5>Data Ekstrakulikuler</h5>
                    </div>
                    <a href="{{ route('eskul.index') }}" class="card-footer space-big-counter-hijau-toska text-center p-2">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            


        <!-- Guru & Walas -->
        <!-- Kartu Data Kelas -->
        <div class="col-md-3 mb-2">
            <div class="card text-white pace-big-counter-hijau-lumut h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
            <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                <p class="h5">{{ $dataEskulCount }}</p>
                <h5>Data Kelas</h5>
            </div>
            <a href="{{ route('kelas.walas') }}" class="card-footer space-big-counter-hijau-lumut text-center p-2">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

        <!-- Kartu Data Pembelajaran -->
        <div class="col-md-3 mb-2">
            <div class="card text-white pace-big-counter-pink-tua h-auto"> <!-- Gunakan h-auto untuk tinggi otomatis -->
            <div class="card-body p-2"> <!-- Mengurangi padding dengan p-2 -->
                <p class="h5">{{ $dataPembelajaranCount }}</p>
                <h5>Data Pembelajaran</h5>
            </div>
            <a href="{{ route('pembelajaran.guru') }}" class="card-footer space-big-counter-pink-tua text-center p-2">
                Lihat detail <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

        <!-- Kartu Profil -->
        <div class="col-md-3 mb-2">
            <div class="card text-white pace-big-counter-merah h-auto" style="min-height: 120px;"> <!-- Atur min-height -->
                <div class="card-body p-2 d-flex align-items-center justify-content-between"> <!-- Flexbox untuk jarak penuh -->
                    <h5 class="mb-0">Data Profile</h5> <!-- Teks di kiri -->
                </div>
                <a href="{{ route('profile.show') }}" class="card-footer space-big-counter-merah text-center p-2">
                    Lihat detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
