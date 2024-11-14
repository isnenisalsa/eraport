@extends('layouts.template')
@section('content')
    <link rel="stylesheet" href="css/style.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('create') }}" class="btn btn-success btn-sm float-left">+ Tambah Data Guru</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>telepon</th>
                                    <th>status</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($guru as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->pendidikan_terakhir }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalDetail{{ $item->nik }}">Detail </button>
                                            <a href="{{ route('edit', $item->nik) }}" class="btn btn-warning">edit</a>
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




    @foreach ($guru as $item)
        <div class="modal fade" id="modalDetail{{ $item->nik }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->nik }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;"> <!-- Perbesar ukuran modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" style="font-size: 18px;">

                            <tr>
                                <th>NIK</th>

                                <td>{{ $item->nik }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $item->status }}</td>
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
                                <th>Jabatan</th>
                                <td>{{ $item->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan Terakhir</th>
                                <td>{{ $item->pendidikan_terakhir }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>{{ $item->no_telp }}</td>
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
                                <th>Agama</th>
                                <td>{{ $item->agama }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $item->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $item->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $item->alamat }}</td>
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
