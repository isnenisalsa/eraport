@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modal-tambah-data-eskul">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl" id="eskulTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Esktrakurikuler</th>
                                    <th>Pembina Esktrakurikuler</th>
                                    <th>Tempat</th>
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


    @include('admin.eskul.create')
    @include('admin.eskul.update')
@endsection
@push('js')
    <script>
        // Tambahkan ini di file JavaScript Anda
        $(document).ready(function() {
            $('#eskulTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('eskul.list') }}', // Sesuaikan dengan URL ke method "list"
                    type: 'POST',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    }, // Kolom nomor
                    {
                        data: 'nama_eskul',
                        name: 'nama_eskul',
                        orderable: false,
                    }, // Nama Eskul
                    {
                        data: 'guru_nama',
                        name: 'guru_nama',
                        orderable: false,
                    }, // Guru Nama (dari relasi)
                    {
                        data: 'tempat',
                        name: 'tempat',
                        orderable: false,
                    }, // Tempat
                    {
                        data: "id",
                        render: function(id) {
                            return `<button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                data-target="#modal-edit${id}">Edit </button>`;
                        },
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    }
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
