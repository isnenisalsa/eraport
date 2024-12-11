@extends('layouts.template')
@section('content')
    <div class="container bg-white shadow">
        <br>
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Kelas</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->nama_kelas }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Guru Pengampu</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->guru->nama }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->tahun_ajarans->tahun_ajaran }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">{{ $breadcrumb->title }}</div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS \ NISN</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($kelas as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->siswa->nis }} \ {{ $item->siswa->nisn }}</td>
                                            <td>{{ $item->siswa->nama }}</td>
                                            <td>{{ $item->siswa->jenis_kelamin }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-md me-2" title="Cover">
                                                    <i class="fas fa-file-alt"> Cover</i>
                                                </button>
                                                <button class="btn btn-success btn-md me-2" title="Biodata">
                                                    <i class="fas fa-id-badge"> Biodata</i>
                                                </button>
                                                <button class="btn btn-primary btn-md" title="Cetak Rapor">
                                                    <i class="fas fa-print"> Rapor</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection