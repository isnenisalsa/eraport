@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">

                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
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
                                    <th>wali kelas</th>
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
                                        <td>
                                            <button type="button" class="btn btn-warning">Edit</button>
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
    <!-- Button trigger modal -->

    <!-- Modal -->

    <div class="modal fade" id="modal-tambah-data-kelas" tabindex="-1" aria-labelledby="modal-tambah-data-kelasLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kode_kelas">Kode Kelas</label>
                                <input type="text" name="kode_kelas" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="guru_nik">Wali Kelas</label>
                                <select name="guru_nik" class="form-control" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->nik }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan
                                    Benar</label>
                            </div>
                            <button type="submit" class="btn btn-success float-right">Simpan</button>

                    </div>
                </div>
            </div>
        @endsection