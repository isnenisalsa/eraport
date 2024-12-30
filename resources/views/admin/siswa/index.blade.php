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
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('create') }}" class="btn btn-success btn-sm float-left">+ Tambah Data Siswa</a>
                        <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                            data-target="#modalImpor">Impor
                            Excel </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-center table-responsive-xl" id="siswaTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status</th>
                                    <th colspan="2">Aksi</th>
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


    @foreach ($siswa as $item)
        <div class="modal fade" id="modalDetail{{ $item->nis }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->nis }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;"> <!-- Perbesar ukuran modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->nis }}">Detail siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-responsive-sm" style="font-size: 18px;">

                            <tr>
                                <th>NIS</th>
                                <td>{{ $item->nis }}</td>
                            </tr>
                            <tr>
                                <th>NISN</th>
                                <td>{{ $item->nisn }}</td>
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
                                <th>Agama</th>
                                <td>{{ $item->agama }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan Sebelumnya</th>
                                <td>{{ $item->pendidikan_terakhir }}</td>
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
                                <th>Alamat Siswa</th>
                                <td>{{ $item->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Orang Tua</th>

                            </tr>
                            <tr>
                                <th>Jalan</th>
                                <td>{{ $item->jalan }}</td>
                            </tr>
                            <tr>
                                <th>Kelurahan/Desa</th>
                                <td>{{ $item->kelurahan }}</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>{{ $item->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <td>{{ $item->kota }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $item->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td>{{ $item->nama_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ayah</th>
                                <td>{{ $item->pekerjaan_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon Ayah</th>
                                <td>{{ $item->no_telp_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $item->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ibu</th>
                                <td>{{ $item->pekerjaan_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon Ibu</th>
                                <td>{{ $item->no_telp_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Nama Wali</th>
                                <td>{{ $item->nama_wali }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Wali</th>
                                <td>{{ $item->pekerjaan_wali }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon Wali</th>
                                <td>{{ $item->no_telp_wali }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Wali</th>
                                <td>{{ $item->alamat_wali }}</td>
                            </tr>
                            <tr>
                                <th>Email Siswa</th>
                                <td>{{ $item->email }}</td>
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


    {{-- modal impor excel --}}
    <div class="modal fade" id="modalImpor" tabindex="-1" aria-labelledby="modalDetaiImpor" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;"> <!-- Perbesar ukuran modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImporLabel">Impor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import') }}" method="POST" name="importform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">File:</label>
                            <input id="file" type="file" name="file" class="form-control">
                        </div>
                        <button class="btn btn-success btn-sm">Import File</button>
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
            $('#siswaTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('siswa.list') }}', // Ganti dengan URL endpoint Anda
                    type: 'POST',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: false
                    }, // Nomor urut
                    {
                        data: 'nis',
                        name: 'nis',
                        orderable: false,
                    },
                    {
                        data: 'nisn',
                        name: 'nisn',
                        orderable: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        orderable: false,
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir',
                        orderable: false,
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        orderable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        data: "nis",
                        render: function(nis) {
                            return `<a href="/siswa/edit/${nis}" class="btn btn-sm btn-primary">Edit</a>`;
                        },
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "nis",
                        render: function(nis) {
                            return `<button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#modalDetail${nis}">Detail</button>`;
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
