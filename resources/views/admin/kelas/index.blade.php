@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah-data-kelas">
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
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit{{ $item->kode_kelas }}">
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
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#modal-tambah-data-kelas').modal('show');
    });
</script>
@endif
<div class="modal fade" id="modal-tambah-data-kelas" tabindex="-1" aria-labelledby="modal-tambah-data-kelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-kelas') }}" method="POST">
                    @csrf
                    <!-- Kode Kelas -->
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" name="kode_kelas" id="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror" value="{{ old('kode_kelas') }}">
                        @error('kode_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}">
                        @error('nama_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Wali Kelas -->
                    <div class="form-group">
                        <label for="guru_nik">Wali Kelas</label>
                        <select name="guru_nik" id="guru_nik" class="form-control @error('guru_nik') is-invalid @enderror">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $item)
                            <option value="{{ $item->nik }}" {{ old('guru_nik') == $item->nik ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('guru_nik')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control @error('tahun_ajaran_id') is-invalid @enderror">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahun as $item)
                            <option value="{{ $item->id }}" {{ old('tahun_ajaran_id') == $item->id ? 'selected' : '' }}>{{ $item->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Checkbox Terms -->
                    <div class="form-check mt-3">
                        <input type="checkbox" name="terms" id="terms" class="form-check-input @error('terms') is-invalid @enderror">
                        <label for="terms" class="form-check-label">Saya yakin sudah mengisi dengan benar</label>
                       <br>
                        @error('terms')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
@foreach ($kelas as $item)
<div class="modal fade" id="modal-edit{{ $item->kode_kelas }}" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-kelas', $item->kode_kelas) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $item->nama_kelas) }}">
                        @error('nama_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Wali Kelas -->
                    <div class="form-group">
                        <label for="guru_nik">Wali Kelas</label>
                        <select name="guru_nik" id="guru_nik" class="form-control @error('guru_nik') is-invalid @enderror">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $guruItem)
                            <option value="{{ $guruItem->nik }}" {{ old('guru_nik', $item->guru_nik) == $guruItem->nik ? 'selected' : '' }}>{{ $guruItem->nama }}</option>
                            @endforeach
                        </select>
                        @error('guru_nik')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control @error('tahun_ajaran_id') is-invalid @enderror">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahun as $tahunItem)
                            <option value="{{ $tahunItem->id }}" {{ old('tahun_ajaran_id', $item->tahun_ajaran_id) == $tahunItem->id ? 'selected' : '' }}>{{ $tahunItem->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
