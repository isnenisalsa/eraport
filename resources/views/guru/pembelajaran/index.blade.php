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
                                                {{ $smt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl"
                            id="tabel_pembelajaran_guru">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Guru Pengampu</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th style="width: 280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#tabel_pembelajaran_guru').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('pembelajaran.list.guru') }}',
                    type: 'POST',
                    data: function(d) {
                        d.tahun_ajaran = $('#filter-tahun-ajaran').val(); // Kirim filter tahun ajaran
                        d.semester = $('#filter-semester').val(); // Kirim filter semester
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        orderable: true,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: 'mata_pelajaran',
                        name: 'mata_pelajaran',
                        orderable: false,
                    },
                    {
                        data: 'nama_kelas',
                        name: 'nama_kelas',
                        orderable: false,
                    },
                    {
                        data: 'guru_nama',
                        name: 'guru_nama',
                        orderable: false,
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran',
                        orderable: false,
                    },
                    {
                        data: 'semester',
                        name: 'semester',
                        orderable: false,
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                    },
                ],
                language: {
                    sProcessing: "Memproses...",
                    sLengthMenu: "Tampilkan _MENU_ entri",
                    sZeroRecords: "Tidak ada data yang sesuai",
                    sInfo: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    sInfoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    sInfoFiltered: "(disaring dari _MAX_ total entri)",
                    sSearch: "Cari:",
                    oPaginate: {
                        sFirst: "<<",
                        sPrevious: "<",
                        sNext: ">",
                        sLast: ">>"
                    }
                },
                info: false,
                autoWidth: false,
            });

            // Event listener untuk filter dropdown
            $('#filter-tahun-ajaran, #filter-semester').on('change', function() {
                table.ajax.reload(); // Reload data dengan filter baru
            });
        });
    </script>
@endpush
