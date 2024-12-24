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
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl" id="kelasWalas">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables
                var table = $('#kelasWalas').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('kelas.list.walas') }}',
                        type: 'POST',
                        data: function(d) {
                            d.tahun_ajaran = $('#filter-tahun-ajaran').val(); // Kirim filter Tahun Ajaran
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
                            name: 'tahun_ajaran'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
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

                // Event listener untuk filter dropdown Tahun Ajaran
                $('#filter-tahun-ajaran').on('change', function() {
                    table.ajax.reload(); // Reload data dengan filter
                });
            });
        </script>
    @endpush
