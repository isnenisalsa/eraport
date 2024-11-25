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
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($tahun_ajaran as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tahun_ajaran }}</td>
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
    <div class="modal fade show @if ($errors->any()) d-block @endif" id="modal-tambah-data-tahun_ajaran" tabindex="-1"
        aria-labelledby="modal-tambah-data-tahun_ajaranLabel" aria-hidden="true"
        style="@if ($errors->any()) display: block; @endif">
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
                                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun_ajaran" placeholder="Inputkan Tahun Ajaran Anda"
                                    name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                                @if ($errors->has('tahun_ajaran'))
                                    <div class="text-danger">{{ $errors->first('tahun_ajaran') }}</div>
                                @endif
                            </div>
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" 
                                    {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">Saya Yakin Sudah Mengisi Dengan Benar</label>
                                @if ($errors->has('terms'))
                                    <div class="text-danger">{{ $errors->first('terms') }}</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
