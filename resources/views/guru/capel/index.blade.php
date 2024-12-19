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
                        <button class="btn btn-warning btn-sm ml-1" id="btn-edit-capel" type="button">Edit Capaian</button>
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-capel">
                            + Tambah Data
                        </button>
                        <a href="{{ route('nilai.index', ['id_pembelajaran' => $id_pembelajaran, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                            class="btn btn-info btn-sm float-right">Kelola Nilai</a> &nbsp;
                    </div>
                    <div id="edit-message" class="alert alert-info" style="display: none;">
                        Anda sudah bisa mengedit
                    </div>
                    <div id="edit-error-message" class="alert alert-danger" style="display: none;">
                        Anda tidak bisa mengedit
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.capel') }}" method="POST">
                            @csrf
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Capaian Pembelajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($Datacapel as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <textarea name="nama_capel[]" class="form-control capel-textarea" rows="3" required readonly>{{ $item->nama_capel ?? old('nama_capel.' . $loop->index) }}</textarea>
                                                @error('nama_capel.' . $loop->index)
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
                    <h5 class="modal-title"><b>TAMBAH DATA CAPAIAN PEMBELAJARAN</b></h5>
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
                            <label for="nama_capel">Capaian Pembelajaran</label>
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
                        <p>Data Capaian Pembelajaran:</p>
                        <p style="color: rgb(18, 192, 255)">{{ $item->nama_capel }}</p>
                        <b>
                            <p>Seluruh data yang berkaitan dengan Capaian Pembelajaran tersebut akan dihapus!</p>
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
