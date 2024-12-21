@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->nama_kelas }}</th> <!-- Langsung akses nama_kelas -->
                        </tr>
                        <tr>
                            <th scope="col">Wali Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->guru->nama ?? 'Tidak Ditemukan' }}</th>
                            <!-- Langsung akses nama guru -->
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
                    <div class="card-header bg-light text-white">
                        <strong>Daftar Siswa - {{ $kelas->nama_kelas }}</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr class="text-center">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->siswa->nis }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('walas.cover', $item->siswa->nis) }}"
                                                class="btn btn-danger btn-md me-2" title="Cover"
                                                style="margin-bottom: 5px">
                                                <i class="fas fa-file-alt"> Cover</i>
                                            </a>
                                            <a href="{{ route('walas.biodata', ['nis' => $item->siswa->nis, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                                                class="btn btn-primary btn-md me-2" title="Lihat Biodata"
                                                style="margin-bottom: 5px">
                                                <i class="fas fa-file-alt"> Biodata</i>
                                            </a>
                                            <a href="{{ route('walas.rapor', ['kode_kelas' => $kode_kelas, 'nis' => $item->siswa->nis, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                                                class="btn btn-success btn-md me-2" title="Lihat Rapor"
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
@endsection
