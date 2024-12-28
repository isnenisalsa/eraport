@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->mapel->mata_pelajaran }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->kelas->nama_kelas }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->guru->nama }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Semester</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $semester }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center" style="height: 50vh; overflow-y: scroll;">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-capel">
                            + Tambah Data
                        </button>
                        <a href="{{ route('nilai.index', ['id_pembelajaran' => $id_pembelajaran, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                            class="btn btn-info btn-sm float-right">Kelola Nilai</a>
                    </div>
                    <div id="edit-message" class="alert alert-info" style="display: none;">
                        Anda sudah bisa mengedit
                    </div>
                    <div id="edit-error-message" class="alert alert-danger" style="display: none;">
                        Anda tidak bisa mengedit
                    </div>
                    <div class="card-body">
                        <button class="btn btn-warning btn-sm ml-1 mb-3" id="btn-edit-capel" type="button">Edit Tujuan
                            Pembelajaran</button>
                        <form action="{{ route('update.capel') }}" method="POST">
                            @csrf
                            <table class="table table-bordered table-striped text-center table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tujuan Pembelajaran</th>
                                        <th>Lingkup Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($Datacapel as $item)
                                        <tr class="text-center">
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <textarea name="nama_capel[]" class="form-control capel-textarea" rows="3" required readonly>{{ $item->nama_capel ?? old('nama_capel.' . $loop->index) }}</textarea>
                                                @error('nama_capel.' . $loop->index)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <select name="lingkup_id[]" class="form-select capel-select" required
                                                    disabled>
                                                    <option value="" disabled>Pilih Lingkup Materi</option>
                                                    @foreach ($DataLingkup as $lingkup)
                                                        <option value="{{ $lingkup->id }}"
                                                            {{ $lingkup->id == $item->lingkup_id ? 'selected' : '' }}>
                                                            {{ $lingkup->nama_lingkup_materi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('lingkup_id.' . $loop->index)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-hapus-data-capel{{ $item->id }}">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data capel -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#modal-tambah-data-capel').modal('show');
            });
        </script>
    @endif
    <div class="modal fade" id="modal-tambah-data-capel" tabindex="-1" aria-labelledby="modal-tambah-data-capelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>TAMBAH DATA TUJUAN PEMBELAJARAN</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ route('save.capel', ['id_pembelajaran' => $id_pembelajaran, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="lingkup_id">Lingkup Materi</label>
                            <select name="lingkup_id" id="lingkup_id" class="form-select">
                                <option value="" disabled selected>Pilih Lingkup Materi</option>
                                @foreach ($DataLingkup as $lingkup)
                                    <option value="{{ $lingkup->id }}">{{ $lingkup->nama_lingkup_materi }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('lingkup_id'))
                                <span class="text-danger">{{ $errors->first('lingkup_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nama_capel">Tujuan Pembelajaran</label>
                            <textarea name="nama_capel" id="nama_capel" class="form-control" rows="3" required></textarea>

                            @if ($errors->has('nama_capel'))
                                <span class="text-danger">{{ $errors->first('nama_capel') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($Datacapel as $item)
        <!-- Modal Hapus Data capel -->
        <div class="modal fade" id="modal-hapus-data-capel{{ $item->id }}" tabindex="-1"
            aria-labelledby="modal-hapus-data-capelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Data Tujuan Pembelajaran:</p>
                        <p style="color: rgb(18, 192, 255)">{{ $item->nama_capel }}</p>
                        <b>
                            <p>Seluruh data yang berkaitan dengan Tujuan Pembelajaran tersebut akan dihapus!</p>
                        </b>
                        <b>
                            <p>Apakah anda yakin data tersebut akan dihapus?</p>
                        </b>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                        <form action="{{ route('delete.capel', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Menginisialisasi Select2 untuk elemen dengan kelas 'capel-select'
            $('.capel-select').select2({
                placeholder: 'Pilih Lingkup Materi', // Placeholder jika tidak ada yang dipilih
                allowClear: true, // Menambahkan tombol clear untuk memilih ulang
                width: '100%',
                dropdownAutoWidth: true, // Membuat dropdown selebar elemen
                dropdownPosition: 'below', // Default dropdown ke bawah
            });
        });
        $(document).ready(function() {
            // Menginisialisasi Select2 untuk elemen dengan kelas 'capel-select'
            $('#lingkup_id').select2({
                placeholder: 'Pilih Lingkup Materi', // Placeholder jika tidak ada yang dipilih
                allowClear: true, // Menambahkan tombol clear untuk memilih ulang
                width: '100%',
                dropdownAutoWidth: true, // Membuat dropdown selebar elemen
                dropdownPosition: 'below', // Default dropdown ke bawah
            });
        });
    </script>
@endpush
