@extends('layouts.template')
@section('content')
    <div class="card mx-auto" style="width: 1200px">

        <div class="card-body">
            <a href="{{ route('create') }}" class="btn btn-success btn-sm"> + Tambah Data Guru</a>

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
                                <a href="" class="btn btn-primary">detail</a>
                                <a href="" class="btn btn-warning">edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
