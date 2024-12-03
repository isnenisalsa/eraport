@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modal-tambah-data-eskul">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembina Esktrakulikuler</th>
                                    <th>Nama Esktrakulikuler</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($eskul as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->guru->nama }}</td>
                                        <td>{{ $item->nama_eskul }}</td>
                                        <td>{{ $item->tempat }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-edit{{ $item->id }}">
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


    @include('admin.eskul.create')
    @include('admin.eskul.update')
@endsection
