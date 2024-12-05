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
                                    <th>Nis</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>tahun ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($eskul_siswa as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>

                                        <td>{{ $item->siswa->siswa->nis }}</td>
                                        <td>{{ $item->siswa->siswa->nisn }}</td>
                                        <td>{{ $item->siswa->siswa->nama }}</td>
                                        <td>{{ $item->siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $item->siswa->kelas->tahun_ajarans->tahun_ajaran }}</td>

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
    @include('pembina_eskul.siswa.modal')

@endsection
