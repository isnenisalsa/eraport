@extends('layouts.template')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <!-- Kartu Data Siswa -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-danger h-auto">
                        <div class="card-body p-2">
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
                    <div class="card text-white bg-success h-auto">
                        <div class="card-body p-2">
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
                    <div class="card text-white bg-lightblue h-auto">
                        <div class="card-body p-2">
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
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                <div class="col-md-3 mb-2">
                    <div class="card text-white bg-lightblue h-auto">
                        <div class="card-body p-2">
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
                        <div class="card-body p-2">
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
                    <div class="card-body p-2 d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Profile</h5>
                    </div>
                    <a href="{{ route('profile.show') }}" class="card-footer gradiens-big-counter-ungu text-center p-2">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- School Data and Looker Dashboard -->
        <div class="row">
            <!-- Left Column: School Data -->
            <div class="col-md-6">
                <div class="card text-white bg-gradient-green h-auto">
                    <div class="card-body p-2">
                        <h5>{{ $sekolah->nama ?? '-' }}</h5>
                        <p><strong>NPSN:</strong> {{ $sekolah->npsn ?? '-' }}</p>
                        <p><strong>NSS:</strong> {{ $sekolah->nss ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $sekolah->alamat ?? '-' }}</p>
                        <p><strong>Desa:</strong> {{ $sekolah->desa ?? '-' }}</p>
                        <p><strong>Kecamatan:</strong> {{ $sekolah->kecamatan ?? '-' }}</p>
                        <p><strong>Kabupaten:</strong> {{ $sekolah->kabupaten ?? '-' }}</p>
                        <p><strong>Provinsi:</strong> {{ $sekolah->provinsi ?? '-' }}</p>
                        <p><strong>Nama Kepala Sekolah:</strong> {{ $sekolah->nama_kepsek ?? '-' }}</p>
                        <p><strong>NIP Kepala Sekolah:</strong> {{ $sekolah->nip_kepsek ?? '-' }}</p>
                    </div>

                </div>
            </div>

            <!-- Right Column: Looker Dashboard -->
            <div class="col-md-6">
                <div class="looker">
                    <iframe width="600" height="450"
                        src="https://lookerstudio.google.com/embed/reporting/b622b982-aa91-4a8d-b0f2-657e1e7e09d3/page/pbMaE"
                        frameborder="0" style="border:0" allowfullscreen
                        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
