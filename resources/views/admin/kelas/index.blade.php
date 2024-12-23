@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modal-tambah-data-kelas">
                            + Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl" id="kelas-tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Wali Kelas</th>
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
    </div>
    <!-- Modal Tambah Data -->
    @include('admin.kelas.create')

    <!-- Modal Edit Data -->
    @include('admin.kelas.update')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#kelas-tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kelas.list') }}",
                    type: "POST",
                },
                columns: [{
                        data: "DT_RowIndex",
                        orderable: true,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "kode_kelas",
                        orderable: false
                    },
                    {
                        data: "nama_kelas",
                        orderable: false
                    },
                    {
                        data: "guru.nama",
                        orderable: false
                    }, {
                        data: "nama_tahun",
                        orderable: false,
                    }, {
                        data: "kode_kelas",
                        render: function(kode_kelas) {
                            return `<button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                data-target="#modal-edit${kode_kelas}">edit </button>`;
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
        $(document).ready(function() {
            $('#tahun_ajaran_id').select2({
                dropdownParent: $('#modal-tambah-data-kelas'),
                placeholder: "Pilih Tahun Ajaran",
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Tidak ada hasil ditemukan";
                    }
                }
            });
        });
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen dengan ID yang dimulai dengan "tahun_ajaran_id_edit"
            $('[id^="tahun_ajaran_id_edit"]').each(function() {
                var modalId = $(this).closest('.modal').attr(
                    'id'); // Menemukan ID modal terkait

                $(this).select2({
                    dropdownParent: $('#' +
                        modalId), // Set dropdownParent sesuai dengan modal yang terkait
                    placeholder: "Pilih Tahun Ajaran",
                    allowClear: true,
                    width: '100%',
                    language: {
                        noResults: function() {
                            return "Tidak ada hasil ditemukan";
                        }
                    }
                });
            });
        });
    </script>
@endpush
