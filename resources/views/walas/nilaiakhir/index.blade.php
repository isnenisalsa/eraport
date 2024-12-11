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

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="example2">
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
                                @php $no = 1; @endphp
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
                                                <a href="{{ route('nilai.akhir.index', ['kode_kelas' => $item->kode_kelas, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                    class="btn btn-primary">Detail</a>

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
