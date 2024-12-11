@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Kartu Data Kelas -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h4>Data Kelas</h4>
                </div>
                <div class="card-footer bg-primary text-right">
<a href="{{ route('kelas.walas') }}">Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu Data Pembelajaran -->
        <div class="col-md-4">
            <div class="card text-white bg-purple mb-3">
                <div class="card-body">
                    <h4>Data Pembelajaran</h4>
                </div>
                <div class="card-footer bg-purple text-right">
                    <a href="{{ route('pembelajaran.guru') }}" class="text-white">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kartu Profil -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h4>Profil Saya</h4>
                </div>
                <div class="card-footer bg-info text-right">
                    <a href="profile" class="text-white">
                        Lihat detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
