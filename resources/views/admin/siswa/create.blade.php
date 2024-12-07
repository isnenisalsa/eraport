@extends('layouts.template')
@section('content')
    <br>
    <div class="card card-blue">
        <h5 class="card-header text-center">Tambah Data Siswa</h5>

        <div class="card-body" style="max-height: 50vh; overflow-y: auto;">
            <form method="POST" action="{{ route('save-siswa') }}">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" placeholder="Inputkan NIS Anda"
                                name="nis" value="{{ old('nis') }}" maxlength="6">
                            @if ($errors->has('nis'))
                                <div class="text-danger">{{ $errors->first('nis') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" placeholder="Inputkan NISN Anda"
                                name="nisn" value="{{ old('nisn') }}" maxlength="10">
                            @if ($errors->has('nisn'))
                                <div class="text-danger">{{ $errors->first('nisn') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Inputkan Nama Anda"
                                name="nama" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <div class="text-danger">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="Laki-Laki" {{ old('status') == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan" {{ old('status') == 'perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <div class="text-danger">{{ $errors->first('jenis_kelamin') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-control" name="agama" id="agama">
                                <option value="">Pilih</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen
                                </option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha
                                </option>
                            </select>
                            @if ($errors->has('agama'))
                                <div class="text-danger">{{ $errors->first('agama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan_terakhir" placeholder="Inputkan Pendidikan Terakhir Siswa"
                                name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}">
                            @if ($errors->has('pendidikan_terakhir'))
                                <div class="text-danger">{{ $errors->first('pendidikan_terakhir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir"
                                placeholder="Inputkan Tempat Lahir Anda" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                            @if ($errors->has('tempat_lahir'))
                                <div class="text-danger">{{ $errors->first('tempat_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                            @if ($errors->has('tanggal_lahir'))
                                <div class="text-danger">{{ $errors->first('tanggal_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Siswa</label>
                            <input type="text" class="form-control" placeholder="Inputkan Alamat Anda" id="alamat"
                                name="alamat" value="{{ old('alamat') }}">
                            @if ($errors->has('alamat'))
                                <div class="text-danger">{{ $errors->first('alamat') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jalan" class="form-label">Alamat Orang Tua</label>
                            <input type="text" class="form-control" placeholder="Inputkan Jalan" id="jalan"
                                name="jalan" value="{{ old('jalan') }}">
                            @if ($errors->has('jalan'))
                                <div class="text-danger">{{ $errors->first('nama_jalan') }}</div>
                            @endif
                            <label for="kelurahan" class="form-label"></label>
                            <input type="text" class="form-control" placeholder="Inputkan Kelurahan/Desa" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}">
                            @if ($errors->has('kelurahan'))
                                <div class="text-danger">{{ $errors->first('kelurahan') }}</div>
                            @endif
                            <label for="kecamatan" class="form-label"></label>
                            <input type="text" class="form-control" placeholder="Inputkan Kecamatan" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                            @if ($errors->has('kecamatan'))
                                <div class="text-danger">{{ $errors->first('kecamatan') }}</div>
                            @endif
                            <label for="kota" class="form-label"></label>
                            <input type="text" class="form-control" placeholder="Inputkan Kabupaten/Kota" id="kota" name="kota" value="{{ old('kota') }}">
                            @if ($errors->has('kota'))
                                <div class="text-danger">{{ $errors->first('kota') }}</div>
                            @endif
                            <label for="provinsi" class="form-label"></label>
                            <input type="text" class="form-control" placeholder="Inputkan Provinsi" id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
                            @if ($errors->has('provinsi'))
                                <div class="text-danger">{{ $errors->first('provinsi') }}</div>
                            @endif
                        </div> 
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" placeholder="Inputkan Nama Ayah"
                                name="nama_ayah" value="{{ old('nama_ayah') }}">
                            @if ($errors->has('nama_ayah'))
                                <div class="text-danger">{{ $errors->first('nama_ayah') }}</div>
                            @endif
                            </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" id="pekerjaan_ayah"
                                placeholder="Inputkan Pekerjaan Ayah" name="pekerjaan_ayah"
                                value="{{ old('pekerjaan_ayah') }}">
                            @if ($errors->has('pekerjaan_ayah'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_ayah') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_ayah" class="form-label">Nomor Telepon Ayah</label>
                            <input type="text" class="form-control" id="no_telp_ayah"
                                placeholder="Inputkan Nomor Telepon Ayah" name="no_telp_ayah"
                                value="{{ old('no_telp_ayah') }}">
                            @if ($errors->has('no_telp_ayah'))
                                <div class="text-danger">{{ $errors->first('no_telp_ayah') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" placeholder="Inputkan Nama Ibu"
                                name="nama_ibu" value="{{ old('nama_ibu') }}">
                            @if ($errors->has('nama_ibu'))
                                <div class="text-danger">{{ $errors->first('nama_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" id="pekerjaan_ibu"
                                placeholder="Inputkan Pekerjaan Ibu" name="pekerjaan_ibu"
                                value="{{ old('pekerjaan_ibu') }}">
                            @if ($errors->has('pekerjaan_ibu'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_ibu" class="form-label">Nomor Telepon Ibu</label>
                            <input type="text" class="form-control" id="no_telp_ibu"
                                placeholder="Inputkan Nomor Telepon Ibu" name="no_telp_ibu"
                                value="{{ old('no_telp_ibu') }}">
                            @if ($errors->has('no_telp_ibu'))
                                <div class="text-danger">{{ $errors->first('no_telp_ibu') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" placeholder="Inputkan Nama Wali"
                                name="nama_wali" value="{{ old('nama_wali') }}">
                            @if ($errors->has('nama_wali'))
                                <div class="text-danger">{{ $errors->first('nama_wali') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                            <input type="text" class="form-control" id="pekerjaan_wali"
                                placeholder="Inputkan Pekerjaan Wali" name="pekerjaan_wali"
                                value="{{ old('pekerjaan_wali') }}">
                            @if ($errors->has('pekerjaan_wali'))
                                <div class="text-danger">{{ $errors->first('pekerjaan_wali') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_wali" class="form-label">Nomor Telepon Wali</label>
                            <input type="text" class="form-control" id="no_telp_wali"
                                placeholder="Inputkan Nomor Telepon Wali" name="no_telp_wali"
                                value="{{ old('no_telp_wali') }}">
                            @if ($errors->has('no_telp_wali'))
                                <div class="text-danger">{{ $errors->first('no_telp_wali') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="alamat_wali" class="form-label">Alamat Wali</label>
                            <input type="text" class="form-control" id="alamat_wali"
                                placeholder="Inputkan Alamat Wali" name="alamat_wali"
                                value="{{ old('alamat_wali') }}">
                            @if ($errors->has('alamat_wali'))
                                <div class="text-danger">{{ $errors->first('alamat_wali') }}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms">
                    <label class="form-check-label" for="terms" required>Saya Yakin Sudah Mengisi Dengan
                        Benar</label>
                    @if ($errors->has('terms'))
                        <div class="text-danger">{{ $errors->first('terms') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
