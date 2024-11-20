@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal"
                            data-target="#modal-tambah-data-kelas">
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

    <!-- Modal -->

    <div class="modal fade" id="modal-tambah-data-kelas" tabindex="-1" aria-labelledby="modal-tambah-data-kelasLabel"
        aria-hidden="true">
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
                            <input type="text" name="id_pembelajaran" placeholder="Inputkan ID Pembelajaran"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-control" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->kode_mapel }}">{{ $item->mata_pelajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <select name="nama_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kode_kelas }}">{{ $item->nama_kelas }} -
                                        {{ $item->tahun_ajar->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_guru">Guru Pengampu</label>
                            <select name="nama_guru" class="form-control" required>
                                <option value="">Pilih Guru</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->nik }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1">Saya yakin data sudah benar</label>
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
        <div class="modal fade" id="modal-edit{{ $item->id_pembelajaran }}" tabindex="-1"
            aria-labelledby="modal-editLabel" aria-hidden="true">
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
