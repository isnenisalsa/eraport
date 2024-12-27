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
                        <button class="btn btn-warning btn-sm ml-1" id="btn-edit-lingkup" type="button">Edit Lingkup
                            Materi</button>
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-lingkup">
                            + Tambah Data
                        </button>

                    </div>
                    <div id="edit-message" class="alert alert-info" style="display: none;">
                        Anda sudah bisa mengedit
                    </div>
                    <div id="edit-error-message" class="alert alert-danger" style="display: none;">
                        Anda tidak bisa mengedit
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.lingkup') }}" method="POST">
                            @csrf
                            <table class="table table-bordered table-striped text-center table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lingkup Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($DataLingkup as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <textarea name="nama_lingkup_materi[]" class="form-control lingkup-textarea" rows="3" required readonly>{{ $item->nama_lingkup_materi ?? old('nama_lingkup_materi.' . $loop->index) }}</textarea>
                                                @error('nama_lingkup_materi.' . $loop->index)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-hapus-data-lingkup_materi{{ $item->id }}">
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

    <!-- Modal Tambah Data lingkup_materi -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#modal-tambah-data-lingkup_materi').modal('show');
            });
        </script>
    @endif
    <div class="modal fade" id="modal-tambah-data-lingkup" tabindex="-1" aria-labelledby="modal-tambah-data-lingkupLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>TAMBAH DATA LINGKUP MATERI</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ route('save.lingkup', ['id_pembelajaran' => $id_pembelajaran, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_lingkup_materi">Lingkup Materi</label>
                            <textarea name="nama_lingkup_materi" id="nama_lingkup_materi" class="form-control" rows="3" required></textarea>

                            @if ($errors->has('nama_lingkup_materi'))
                                <span class="text-danger">{{ $errors->first('nama_lingkup_materi') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($DataLingkup as $item)
        <!-- Modal Hapus Data lingkup_materi -->
        <div class="modal fade" id="modal-hapus-data-lingkup_materi{{ $item->id }}" tabindex="-1"
            aria-labelledby="modal-hapus-data-lingkup_materiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Data Lingkup Materi:</p>
                        <p style="color: rgb(18, 192, 255)">{{ $item->nama_lingkup_materi }}</p>
                        <b>
                            <p>Seluruh data yang berkaitan dengan Lingkup Materi tersebut akan dihapus!</p>
                        </b>
                        <b>
                            <p>Apakah anda yakin data tersebut akan dihapus?</p>
                        </b>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                        <form action="{{ route('delete.lingkup', $item->id) }}" method="POST">
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
