@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-tahun_ajaran">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl"
                            id="tahunAjarTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>tanggal biodata</th>
                                    <th>tanggal pembagian rapor</th>
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
    <!-- Modal Tambah Data -->
    @include('admin.tahun_ajaran.create')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#tahunAjarTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('tahun.list') }}', // Ganti dengan URL endpoint Anda
                    type: 'POST',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    }, // Nomor urut
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran',
                        orderable: false,
                    }, // Tahun Ajaran
                    {
                        data: 'semester',
                        name: 'semester',
                        orderable: false,
                    }, // Semester
                    {
                        data: 'tanggal_biodata',
                        name: 'tanggal_biodata',
                        orderable: false,
                    }, // Tanggal Biodata
                    {
                        data: 'tanggal_pembagian_rapor',
                        name: 'tanggal_pembagian_rapor',
                        orderable: false,
                    }, // Tanggal Pembagian Rapor
                ],
                info: false,
                autoWidth: false, // Mencegah DataTables menghitung lebar kolom secara otomatis
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Semua"]
                ], // Opsi menu panjang tabel
                pageLength: 5, // Jumlah baris per halaman
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
        });
    </script>
@endpush
