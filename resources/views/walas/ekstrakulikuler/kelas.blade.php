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
                            <table class="table table-bordered table-striped text-center" id="tabel_eskul_walas">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#tabel_eskul_walas').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('eskul.list.walas') }}',
                    type: 'POST',
                    data: function(d) {
                        d.tahun_ajaran = $('#filter-tahun-ajaran').val();
                        d.semester = $('#filter-semester').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kelas',
                        name: 'nama_kelas'
                    },
                    {
                        data: 'guru_nama',
                        name: 'guru_nama'
                    },
                    {
                        data: 'jumlah_siswa',
                        name: 'jumlah_siswa'
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'semester',
                        name: 'semester',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                info: false,
                autoWidth: false,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Semua"]
                ],
                pageLength: 5,
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
                }
            });

            // Event listener untuk filter dropdown tahun ajaran
            $('#filter-tahun-ajaran').on('change', function() {
                table.ajax.reload(null, false); // Reload data tanpa reset pagination
            });

            // Event listener untuk filter dropdown semester
            $('#filter-semester').on('change', function() {
                table.ajax.reload(null, false); // Reload data tanpa reset pagination
            });

            // Terapkan filter awal jika ada nilai default
            var defaultYear = $('#filter-tahun-ajaran').val();
            var defaultSemester = $('#filter-semester').val();

            if (defaultYear || defaultSemester) {
                table.ajax.reload(null, false);
            }
        });
    </script>
@endpush
