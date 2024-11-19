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
                                    <th>Nama</th>
                                    <th>NIS</th>
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
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->nama_ayah }}</td>
                                        <td>{{ $item->nama_ibu }}</td>
                                        <td>{{ $item->pekerjaan_ayah }}</td>
                                        <td>{{ $item->pekerjaan_ibu }}</td>
                                        <td>{{ $item->no_telp_ayah }}</td>
                                        <td>{{ $item->no_telp_ibu }}</td>
                                        <td>{{ $item->nama_wali }}</td>
                                        <td>{{ $item->pekerjaan_wali }}</td>
                                        <td>{{ $item->no_telp_wali }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalDetail{{ $item->nis }}">Detail </button>  
                                            <a href="{{ route('edit', $item->nis) }}" class="btn btn-warning">edit</a>
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

@endsection
