@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-pembelajaran">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center" id="pembelajaranTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pembelajaran</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nama Kelas</th>
                                    <th>Guru Pengampu</th>
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

    <!-- Modal Tambah Data -->
    @include('admin.pembelajaran.create')

    <!-- Modal Edit Data -->
    @include('admin.pembelajaran.update')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#pembelajaranTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pembelajaran.list') }}", // Ganti dengan route yang sesuai untuk mendapatkan data
                    type: "POST"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'id_pembelajaran',
                        name: 'id_pembelajaran',
                        orderable: false,
                    },
                    {
                        data: 'mapel.mata_pelajaran',
                        name: 'mapel.mata_pelajaran',
                        orderable: false,
                    },
                    {
                        data: 'kelas.nama_kelas',
                        name: 'kelas.nama_kelas',
                        orderable: false,
                    },
                    {
                        data: 'guru.nama',
                        name: 'guru.nama',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
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
