@extends('layouts.template')
@section('content')
    <link rel="stylesheet" href="css/style.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('create') }}" class="btn btn-success btn-sm float-left">+ Tambah Data Siswa</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalDetail{{ $item->nis }}">Detail </button>  
                                            <a href="{{ route('edit-siswa', $item->nis) }}" class="btn btn-warning">edit</a>
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
    @foreach ($siswa as $item)
        <div class="modal fade" id="modalDetail{{ $item->nis }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->nis }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;"> <!-- Perbesar ukuran modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->nis }}">Detail siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" style="font-size: 18px;">

                            <tr>
                                <th>nis</th>

                                <td>{{ $item->nis }}</td>
                            </tr>
                            <tr>
                                <th>nisn</th>
                                <td>{{ $item->nisn }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $item->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $item->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $item->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $item->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $item->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td>{{ $item->nama_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ayah</th>
                                <td>{{ $item->pekerjaan_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon Ayah</th>
                                <td>{{ $item->no_telp_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $item->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ibu</th>
                                <td>{{ $item->pekerjaan_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon Ibu</th>
                                <td>{{ $item->no_telp_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Nama Wali</th>
                                <td>{{ $item->nama_wali }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Wali</th>
                                <td>{{ $item->pekerjaan_wali }}</td>
                            </tr><tr>
                                <th>Nomor Telepon Wali</th>
                                <td>{{ $item->no_telp_wali }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
