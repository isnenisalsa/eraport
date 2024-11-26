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
                        <table class="table table-bordered table-striped text-center" id="example2">
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
                                @php $no = 1; @endphp
                                @foreach ($pembelajaran as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->id_pembelajaran }}</td>
                                        <td>{{ $item->mapel->mata_pelajaran }}</td>
                                        <td>{{ $item->kelas->nama_kelas }}</td>
                                        <td>{{ $item->guru->nama }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-edit{{ $item->id_pembelajaran }}">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal Tambah Data -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#modal-tambah-data-pembelajaran').modal('show');
            });
        </script>
    @endif
    <div class="modal fade" id="modal-tambah-data-pembelajaran" tabindex="-1"
        aria-labelledby="modal-tambah-data-pembelajaranLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('save-pembelajaran') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_pembelajaran">ID Pembelajaran</label>
                            <input type="text" name="id_pembelajaran" id="id_pembelajaran"
                                class="form-control @error('id_pembelajaran') is-invalid @enderror"
                                value="{{ old('id_pembelajaran') }}">
                            @error('id_pembelajaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-control">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->kode_mapel }}"
                                        @if (old('mata_pelajaran', $item->mapel_kode_mapel) == $item->kode_mapel) selected @endif>
                                        {{ $item->mata_pelajaran }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>

                            <select name="nama_kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $kelasitem)
                                    <option value="{{ $kelasitem->kode_kelas }}"
                                        @if (old('nama_kelas', $kelasitem->kelas_kode_kelas) == $kelasitem->kode_kelas) selected @endif>
                                        {{ $kelasitem->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_kelas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_guru">Guru Pengampu</label>

                            <select name="nama_guru" class="form-control">
                                <option value="">Pilih Guru Pengampu</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->nik }}" @if (old('nama_guru', $item->guru_nik) == $item->nik) selected @endif>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_guru')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Checkbox Terms -->
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                name="terms" id="terms">
                            <label class="form-check-label" for="terms">
                                Saya Yakin Sudah Mengisi Dengan Benar
                            </label>
                            <br>
                            @error('terms')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit Data -->
    @foreach ($pembelajaran as $item)
        <div class="modal fade @if (session('editModal') == $item->id_pembelajaran) show @endif" id="modal-edit{{ $item->id_pembelajaran }}"
            tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true"
            style="@if (session('editModal') == $item->id_pembelajaran) display: block; @endif">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pembelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('update-pembelajaran', $item->id_pembelajaran) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_pembelajaran">ID Pembelajaran</label>
                                <input type="text" name="id_pembelajaran" class="form-control"
                                    value="{{ $item->id_pembelajaran }}" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="mata_pelajaran">Mata Pelajaran</label>
                                <select name="mata_pelajaran" class="form-control" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($mapel as $mapelItem)
                                        <option value="{{ $mapelItem->kode_mapel }}"
                                            @if ($item->mapel->kode_mapel == $mapelItem->kode_mapel) selected @endif>
                                            {{ $mapelItem->mata_pelajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_kelas">Nama Kelas</label>
                                <select name="nama_kelas" class="form-control" required>
                                    <option value="">Pilih Nama Kelas</option>
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->kode_kelas }}"
                                            @if ($item->kelas->kode_kelas == $kelasItem->kode_kelas) selected @endif>
                                            {{ $kelasItem->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="guru">Guru Pengampu</label>
                                <select name="nama_guru" class="form-control" required>
                                    <option value="">Pilih Guru Pengampu</option>
                                    @foreach ($guru as $guruItem)
                                        <option value="{{ $guruItem->nik }}"
                                            @if ($item->guru->nik == $guruItem->nik) selected @endif>
                                            {{ $guruItem->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
