@extends('layouts.template')
@section('content')
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
                            data-target="#modal-tambah-data-siswa">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Nis</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                             
                                @foreach ($siswa_kelas as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->siswa->status }}</td>
                                        <td>{{ $item->siswa->nis }}</td>
                                        <td>{{ $item->siswa->nisn }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->siswa->jenis_kelamin }}</td>
                                        <td>{{ $item->siswa->tempat_lahir }}</td>
                                        <td>{{ $item->siswa->tanggal_lahir }}</td>
                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Modal Tambah Data -->

    <div class="modal fade" id="modal-tambah-data-siswa" tabindex="-1" aria-labelledby="modal-tambah-data-siswaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('save-siswa_kelas') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="siswa_id">Siswa</label>
                            <select name="siswa_id" class="form-control" required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->nis }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kode_kelas }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms">
                                    <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan
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


@endsection
