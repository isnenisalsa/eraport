@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modal-tambah-data-kelas">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($kelas as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode_kelas }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>{{ $item->guru->nama }}</td>
                                        <td>{{ $item->tahun_ajarans->tahun_ajaran }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-edit{{ $item->kode_kelas }}">
                                                Edit
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
    <!-- Modal Tambah Data -->
    @include('admin.kelas.create');

    <!-- Modal Edit Data -->
    @include('admin.kelas.update');
@endsection
