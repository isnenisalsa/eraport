@extends('layouts.template')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Data Kelas</h5>
                            <div class="d-flex">
                                <!-- Filter Tahun Ajaran -->
                                <div class="me-3">
                                    <label for="filter-tahun-ajaran" class="form-label mb-0 small">Tahun Ajaran:</label>
                                    <select id="filter-tahun-ajaran" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        @foreach ($tahunAjaran as $tahun)
                                            <option value="{{ $tahun }}"
                                                {{ $tahun == $tahunAjaranTerbaru ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                &nbsp;
                                <!-- Filter Semester -->
                                <div>
                                    <label for="filter-semester" class="form-label mb-0 small">Semester:</label>
                                    <select id="filter-semester" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        @foreach ($semester as $smt)
                                            <option value="{{ $smt }}"
                                                {{ $smt == $semesterTerbaru ? 'selected' : '' }}>
                                                Semester {{ $smt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center" id="tabel_absensi_walas">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Jumlah Siswa</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
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
                                                <td>{{ $tahunAjaran->tahun_ajaran }}</td>
                                                <td>{{ $tahunAjaran->semester }}</td>
                                                <td>
                                                    <a href="{{ route('absensi.index', ['kode_kelas' => $item->kode_kelas, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                        class="btn btn-info btn-sm">
                                                        Detail
                                                    </a>
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
    </div>
@endsection
