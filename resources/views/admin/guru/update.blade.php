@extends('layouts.template')
@section('content')
    <div class="card card-blue">
        <h5 class="card-header text-center">Edit Data Guru</h5>

        <div class="card-body" style="max-height: 50vh; overflow-y: auto;">
            <form method="POST" action="{{ route('update', $guru->nik) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                Status <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Pilih</option>
                                <option value="Aktif" {{ old('status', $guru->status) == 'Aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="Tidak Aktif"
                                    {{ old('status', $guru->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>
                            @if ($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">
                                NIK <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nik" placeholder="Inputkan NIK Anda"
                                name="nik" value="{{ $guru->nik }}" maxlength="16">
                            @if ($errors->has('nik'))
                                <div class="text-danger">{{ $errors->first('nik') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">
                                NIP 
                            </label>
                            <input type="text" class="form-control" id="nip" placeholder="Inputkan NIP Anda"
                                name="nip" value="{{ $guru->nip }}">
                            @if ($errors->has('nip'))
                                <div class="text-danger">{{ $errors->first('nip') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama" value="{{ $guru->nama }} "
                                placeholder="Inputkan Nama Anda" name="nama">
                            @if ($errors->has('nama'))
                                <div class="text-danger">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelaminn" class="form-label">
                                Jenis Kelamin <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="Laki-Laki"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <div class="text-danger">{{ $errors->first('jenis_kelamin') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">
                                Jabatan <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="jabatan" value="{{ $guru->jabatan }} "
                                placeholder="Inputkan Jabatan Anda" name="jabatan">
                            @if ($errors->has('jabatan'))
                                <div class="text-danger">{{ $errors->first('jabatan') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pendidikan_terakhir" class="form-label">
                                Pendidikan Terakhir <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="pendidikan"
                                value="{{ $guru->pendidikan_terakhir }} " placeholder="Inputkan Pendidikan Terakhir Anda"
                                name="pendidikan_terakhir">
                            @if ($errors->has('pendidikan_terakhir'))
                                <div class="text-danger">{{ $errors->first('pendidikan_terakhir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">
                                Nomer Telepon <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" value="{{ $guru->no_telp }} " id="telepon"
                                placeholder="Inputkan Nomor Telepon Anda" name="no_telp" maxlength="13">
                            @if ($errors->has('no_telp'))
                                <div class="text-danger">{{ $errors->first('no_telp') }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">
                                Tempat Lahir <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" value="{{ $guru->tempat_lahir }} "
                                id="tempat_lahir" placeholder="Inputkan Tempat Lahir Anda" name="tempat_lahir">
                            @if ($errors->has('tempat_lahir'))
                                <div class="text-danger">{{ $errors->first('tempat_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">
                                Tanggal Lahir <span class="required" style="color: red">*</span>
                            </label>
                            <input type="date" class="form-control"
                                value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" id="tanggal_lahir"
                                placeholder="Inputkan Tanggal Lahir Anda" name="tanggal_lahir">
                            @if ($errors->has('tanggal_lahir'))
                                <div class="text-danger">{{ $errors->first('tanggal_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">
                                Agama <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="agama" id="agama">
                                <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                            </select>
                            @if ($errors->has('agama'))
                                <div class="text-danger">{{ $errors->first('agama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">
                                Nama Ibu <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" value="{{ $guru->nama_ibu }} " id="nama_ibu"
                                placeholder="Inputkan Nama Ibu Anda" name="nama_ibu">
                            @if ($errors->has('nama_ibu'))
                                <div class="text-danger">{{ $errors->first('nama_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="status_perkawinan" class="form-label">
                                Status Pernikahan <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="status_perkawinan" id="status_perkawinan">
                                <option value="">Pilih</option>
                                <option value="Menikah"
                                    {{ old('status_perkawinan', $guru->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>
                                    Menikah</option>
                                <option value="Belum Menikah"
                                    {{ old('status_perkawinan', $guru->status_perkawinan) == 'Belum Menikah' ? 'selected' : '' }}>
                                    Belum Menikah</option>
                            </select>
                            @if ($errors->has('status_perkawinan'))
                                <div class="text-danger">{{ $errors->first('status_perkawinan') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email <span class="required" style="color: red">*</span>
                            </label>
                            <input type="email" class="form-control" id="email" placeholder="Inputkan Email Anda"
                                name="email" value="{{ $guru->email }}">
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="alamat" placeholder="Inputkan Alamat Anda"
                                name="alamat" value="{{ $guru->alamat }}">
                            @if ($errors->has('alamat'))
                                <div class="text-danger">{{ $errors->first('alamat') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1">
                    <label class="form-check-label" for="terms">Saya Yakin Sudah Mengisi Dengan Benar</label>
                    @if ($errors->has('terms'))
                        <div class="text-danger">{{ $errors->first('terms') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>

            </form>

        </div>
    </div>
@endsection