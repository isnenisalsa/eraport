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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembelajaran as $item)
                                    @foreach ($item->kelas->tahunAjarans as $tahunAjaran)
                                        <tr>
                                            <td>{{ $item->mapel->mata_pelajaran }}</td>
                                            <td>{{ $item->kelas->nama_kelas }}</td>
                                            <td>
                                                <div>{{ $tahunAjaran->tahun_ajaran }} - Semester
                                                    {{ $tahunAjaran->semester }}</div>
                                            </td>
                                            <td>{{ $item->guru->nama }}</td>
                                            <td>

                                                <a href="{{ route('capel.index', ['id_pembelajaran' => $item->id_pembelajaran, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                    class="btn btn-success btn-sm">
                                                    Capaian Pembelajaran
                                                </a> &nbsp;
                                                <a href="{{ route('nilai.index', ['id_pembelajaran' => $item->id_pembelajaran, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                    class="btn btn-info btn-sm">Kelola Nilai</a> &nbsp;
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
