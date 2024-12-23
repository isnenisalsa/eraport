@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('create-guru') }}" class="btn btn-success btn-sm float-left">+ Tambah Data Guru</a>
                        <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                            data-target="#modalImpor">Impor Excel</button>
                    </div>
                    <div class="card-body">
                        <table class="display nowrap table table-bordered table-striped text-center table-responsive-xl "
                            id="guru-tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th style="width: 80px">Jabatan</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>No Telepon</th>
                                    <th>Status</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($guru as $item)
        <!-- Modal for each guru's details -->
        <div class="modal fade" id="modalDetail{{ $item->nik }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->nik }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" style="font-size: 18px;">
                            <tr>
                                <th>Status</th>
                                <td>{{ $item->status }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $item->nik }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $item->nip }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $item->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $item->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $item->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan Terakhir</th>
                                <td>{{ $item->pendidikan_terakhir }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>{{ $item->no_telp }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $item->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $item->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $item->agama }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $item->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $item->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $item->email }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $item->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal for Excel Import -->
    <div class="modal fade" id="modalImpor" tabindex="-1" aria-labelledby="modalImporLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImporLabel">Impor Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import.guru') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File Excel:</label>
                            <input id="file" type="file" name="file" class="form-control" required>
                        </div>
                        <button class="btn btn-success btn-sm" type="submit">Import File</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#guru-tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('guru.list') }}",
                    type: "POST"
                },

                columns: [{
                        data: "DT_RowIndex",
                        orderable: true,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "nama",
                        orderable: false
                    },
                    {
                        data: "jabatan",
                        orderable: false
                    },
                    {
                        data: "pendidikan_terakhir",
                        orderable: false
                    },
                    {
                        data: "no_telp",
                        orderable: false
                    },
                    {
                        data: "status",
                        orderable: false
                    },
                    {
                        data: "nik",
                        render: function(nik) {
                            return `<a href="/guru/edit/${nik}" class="btn btn-sm btn-primary">Edit</a>`;
                        },
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "nik",
                        render: function(nik) {
                            return `<button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#modalDetail${nik}">Detail</button>`;
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
