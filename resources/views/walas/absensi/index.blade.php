@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ $breadcrumb->title }}</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($kelas as $item)
                                    @foreach ($item->tahunAjarans as $tahunAjaran)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_kelas }}</td>
                                            <td>{{ $item->guru->nama }}</td>
                                            <td>{{ $item->siswa_count }}</td>
                                            <td>
                                                <div>{{ $tahunAjaran->tahun_ajaran }} - Semester
                                                    {{ $tahunAjaran->semester }}</div>
                                            </td>
                                            <td>
                                                <a href="{{ route('absensi.index', ['kode_kelas' => $item->kode_kelas, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                    class="btn btn-info">Detail</a>
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
