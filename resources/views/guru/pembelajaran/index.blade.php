@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Guru Pengampu</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembelajaran as $item)
                                    <tr>
                                        <td>{{ $item->mapel->mata_pelajaran }}</td>
                                        <td>{{ $item->kelas->nama_kelas }}</td>
                                        <td>{{ $item->kelas->tahun_ajarans->tahun_ajaran }}</td>
                                        <td>{{ $item->guru->nama }}</td>

                                        <td><a href="{{ route('tupel.index', $item->id_pembelajaran) }}"
                                                class="btn btn-success btn-sm">Tujuan Pembelajaran</a> &nbsp;
                                            <a href="{{ route('nilai.index', $item->id_pembelajaran) }}"
                                                class="btn btn-info btn-sm">Kelola Nilai</a>
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
