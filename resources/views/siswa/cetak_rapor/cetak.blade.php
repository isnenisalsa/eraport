@extends('layouts.template')
@section('content')
    <div class="container bg-white shadow">
        <br>
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Kelas</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->nama_kelas }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Wali Kelas</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->guru->nama }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $kelas->first()->kelas->tahunAjarans->first()->tahun_ajaran }}</th>
                            </tr>
                            <tr>
                                <th scope="col">Semester</th>
                                <th scope="col">:</th>
                                <th scope="col">{{ $semester }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
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
                                        <th>NIS / NISN</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($kelas as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->siswa->nis }} / {{ $item->siswa->nisn }}</td>
                                            <td>{{ $item->siswa->nama }}</td>
                                            <td>{{ $item->siswa->jenis_kelamin }}</td>
                                            <td>
                                                <a href="{{ route('siswa.cover', $item->siswa->nis) }}"
                                                    class="btn btn-danger btn-sm me-2" title="Download Cover"
                                                    style="margin-bottom: 5px">
                                                    <i class="fas fa-file-alt"> Cover</i>
                                                </a>
                                                <a href="{{ route('siswa.biodata', ['nis' => $item->siswa->nis, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                                                    class="btn btn-primary btn-sm me-2" title="Download Biodata"
                                                    style="margin-bottom: 5px">
                                                    <i class="fas fa-file-alt"> Biodata</i>
                                                </a>
                                                <a href="{{ route('siswa.rapor', ['kode_kelas' => $kode_kelas, 'nis' => $nis, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                                                    class="btn btn-success btn-sm me-2" title="Download Rapor"
                                                    style="margin-bottom: 5px"><i class="fas fa-print"> Rapor</i>
                                                </a>
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
    </div>
@endsection
