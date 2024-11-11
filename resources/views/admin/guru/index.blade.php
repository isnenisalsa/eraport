@extends('layouts.template')
@section('content')
    <a href="{{ route('create') }}" class="btn btn-success"> + Tambah Data</a>
    <br><br>
    <div class="card">
        <table class="table" id="example1">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Pendidikan Terakhir</th>
                    <th scope="col">telepon</th>
                    <th scope="col">status</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($guru as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama }} </td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->pendidikan_terakhir }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>{{ $item->status }}</td>
                        <td><a href="" class="btn btn-primary">detail</a>
                            <a href="" class="btn btn-warning">edit</a>
                        </td>



                    </tr>
            </tbody>
            @endforeach

        </table>
    </div>
@endsection
