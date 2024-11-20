@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">

                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-tahun_ajaran">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($tahun_ajaran as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm text-center"
                                                data-toggle="modal" data-target="#modal-edit{{ $item->tahun_ajaran }}">
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

    <div class="modal fade" id="modal-tambah-data-tahun_ajaran" tabindex="-1"
        aria-labelledby="modal-tambah-data-tahun_ajaranLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('save-tahun_ajaran') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" class="form-control" required>
                            </div>
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="terms_tambah" name="terms_tambah"
                                    onchange="toggleButton()">
                                <label class="form-check-label" for="terms_tambah">Saya Yakin Sudah Mengisi Dengan
                                    Benar</label>
                            </div>
                            <button type="submit" class=" btn btn-tambah btn-success float-right">Simpan</button>
                            <script src="js/js.js"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    @foreach ($tahun_ajaran as $item)
        <div class="modal fade" id="modal-edit{{ $item->kode_tahun_ajaran }}" tabindex="-1"
            aria-labelledby="modal-editLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Tahun Ajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="{{ route('update-tahun_ajaran', $item->tahun_ajaran) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kode_tahun_ajaran">Kode Tahun Ajaran</label>
                                    <input type="text" name="kode_tahun_ajaran" class="form-control"
                                        value="{{ $item->kode_tahun_ajaran }}" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control"
                                        value="{{ $item->tahun_ajaran }}" required>
                                </div>

                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms">
                                    <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan
                                        Benar</label>
                                </div>
                                <button type="submit" class="btn btn-success float-right">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
