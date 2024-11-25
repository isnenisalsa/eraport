@extends('layouts.template')
@section('content')
    <div class="container">
        <a href="{{ route('siswa') }}" class="fas fa-solid fa-chevron-left fa-2x " style="margin-left: -50px"></a>
    </div>

    <br>
    <div class="card card-blue">
        <h5 class="card-header text-center">Edit Data Siswa</h5>

        <div class="card-body" style="max-height: 50vh; overflow-y: auto;">
            <form method="POST" action="{{ route('update-siswa', $siswa->nis) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Pilih</option>
                                <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="tidak aktif"
                                    {{ old('status', $siswa->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>
                            @if ($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" placeholder="Inputkan nis Anda"
                                name="nis" value="{{ $siswa->nis }} " maxlength="6" readonly>
                            @if ($errors->has('nis'))
                                <div class="text-danger">{{ $errors->first('nis') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" placeholder="Inputkan nisn Anda"
                                name="nisn" value="{{ $siswa->nisn }} " maxlength="10" readonly>
                            @if ($errors->has('nisn'))
                                <div class="text-danger">{{ $errors->first('nisn') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Inputkan nama Anda"
                                name="nama" value="{{ $siswa->nama }} ">
                            @if ($errors->has('nama'))
                                <div class="text-danger">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="Laki-Laki"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki
                                </option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <div class="text-danger">{{ $errors->first('jenis_kelamin') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir"
                                placeholder="Inputkan tempat_lahir Anda" name="tempat_lahir"
                                value="{{ $siswa->tempat_lahir }} ">
                            @if ($errors->has('tempat_lahir'))
                                <div class="text-danger">{{ $errors->first('tempat_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" id="tanggal_lahir"
                                placeholder="Inputkan Tanggal Lahir Anda" name="tanggal_lahir">
                            @if ($errors->has('tanggal_lahir'))
                                <div class="text-danger">{{ $errors->first('tanggal_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" placeholder="Inputkan alamat Anda"
                                name="alamat" value="{{ $siswa->alamat }} ">
                            @if ($errors->has('alamat'))
                                <div class="text-danger">{{ $errors->first('alamat') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" placeholder="Inputkan nama_ayah Anda"
                                name="nama_ayah" value="{{ $siswa->nama_ayah }} ">
                            @if ($errors->has('nama_ayah'))
                                <div class="text-danger">{{ $errors->first('nama_ayah') }}</div>
                            @endif
                        </div>

                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ayah }} "
                                id="pekerjaan_ayah" placeholder="Inputkan Pekerjaan Ayah" name="pekerjaan_ayah">
                            @if ($errors->has('pekerjaan_ayah'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_ayah') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_ayah" class="form-label">Nomor Telepon Ayah</label>
                            <input type="text" class="form-control" value="{{ $siswa->no_telp_ayah }} "
                                id="no_telp_ayah" placeholder="Inputkan Nomor Telepon Ayah" name="no_telp_ayah">
                            @if ($errors->has('no_telp_ayah'))
                                <div class="text-danger">{{ $errors->first('no_telp_ayah') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" value="{{ $siswa->nama_ibu }} " id="nama_ibu"
                                placeholder="Inputkan Nama Ibu" name="nama_ibu">
                            @if ($errors->has('nama_ibu'))
                                <div class="text-danger">{{ $errors->first('nama_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" value="{{ $siswa->pekerjaan_ibu }} "
                                id="pekerjaan_ibu" placeholder="Inputkan Pekerjaan Ibu" name="pekerjaan_ibu">
                            @if ($errors->has('pekerjaan_ibu'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_ibu" class="form-label">Nomor Telepon Ibu</label>
                            <input type="text" class="form-control" value="{{ $siswa->no_telp_ibu }} "
                                id="no_telp_ibu" placeholder="Inputkan Pekerjaan Ibu" name="no_telp_ibu">
                            @if ($errors->has('no_telp_ibu'))
                                <div class="text-danger">{{ $errors->first('no_telp_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" value="{{ $siswa->nama_wali }} " id="nama_wali"
                                placeholder="Inputkan Nama Wali" name="nama_wali">
                            @if ($errors->has('nama_wali'))
                                <div class="text-danger">{{ $errors->first('nama_wali') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                            <input type="text" class="form-control" value="{{ $siswa->pekerjaan_wali }} "
                                id="pekerjaan_wali" placeholder="Inputkan Pekerjaan Wali" name="pekerjaan_wali">
                            @if ($errors->has('pekerjaan_wali'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_wali') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_wali" class="form-label">Nomor Telepon Wali</label>
                            <input type="text" class="form-control" value="{{ $siswa->no_telp_wali }} "
                                id="no_telp_wali" placeholder="Inputkan Nomor Telepon Wali" name="no_telp_wali">
                            @if ($errors->has('no_telp_wali'))
                                <div class="text-danger">{{ $errors->first('no_telp_wali') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan Benar</label>
                </div>


                <button type="submit" class="btn btn-primary mt-3">Submit</button>

            </form>
        </div>
    </div>
@endsection
