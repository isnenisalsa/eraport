@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->nama_kelas }}</th> <!-- Langsung akses nama_kelas -->
                        </tr>
                        <tr>
                            <th scope="col">Wali Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->guru->nama ?? 'Tidak Ditemukan' }}</th>
                            <!-- Langsung akses nama guru -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-eskul">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($eskuldata as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->siswa->siswa->nama }}</td>
                                        <td>{{ $item->eskul->nama_eskul }}</td>
                                        <td>{{ $item->keterangan }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data -->
    @include('walas.ekstrakulikuler.create')

@endsection
