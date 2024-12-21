@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Data Pembelajaran</h5>
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
                        <table class="table table-bordered table-striped text-center" id="tabel_pembelajaran_guru">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Guru Pengampu</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembelajaran as $item)
                                    @foreach ($item->kelas->tahunAjarans as $tahunAjaran)
                                        <tr>
                                            <td>{{ $item->mapel->mata_pelajaran }}</td>
                                            <td>{{ $item->kelas->nama_kelas }}</td>
                                            <td>{{ $item->guru->nama }}</td>
                                            <td>
                                                {{ $tahunAjaran->tahun_ajaran }}
                                            </td>
                                            <td>
                                                {{ $tahunAjaran->semester }}
                                            </td>
                                            <td>

                                                <a href="{{ route('capel.index', ['id_pembelajaran' => $item->id_pembelajaran, 'tahun_ajaran_id' => $tahunAjaran->id]) }}"
                                                    class="btn btn-success btn-sm">
                                                    Tujuan Pembelajaran
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
