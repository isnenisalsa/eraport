@extends('layouts.template')
@section('content')
    <div class="card card-blue">
        <h5 class="card-header text-center">Tambah Data Guru</h5>

        <div class="card-body" style="max-height: 50vh; overflow-y: auto;">
            <form method="POST" action="{{ route('save-guru') }}">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nik" class="form-label">
                                NIK <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nik" placeholder="Inputkan NIK Anda"
                                name="nik" value="{{ old('nik') }}" maxlength="16">
                            @if ($errors->has('nik'))
                                <div class="text-danger">{{ $errors->first('nik') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">
                                NIP <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nip" placeholder="Inputkan NIP Anda"
                                name="nip" value="{{ old('nip') }}" maxlength="18">
                            @if ($errors->has('nip'))
                                <div class="text-danger">{{ $errors->first('nip') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama" placeholder="Inputkan Nama Anda"
                                name="nama" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <div class="text-danger">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">
                                Jenis Kelamin <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki
                                </option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <div class="text-danger">{{ $errors->first('jenis_kelamin') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">
                                Jabatan <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Inputkan Jabatan Anda"
                                name="jabatan" value="{{ old('jabatan') }}">
                            @if ($errors->has('jabatan'))
                                <div class="text-danger">{{ $errors->first('jabatan') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="pendidikan_terakhir" class="form-label">
                                Pendidikan Terakhir <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="pendidikan"
                                placeholder="Inputkan Pendidikan Terakhir Anda" name="pendidikan_terakhir"
                                value="{{ old('pendidikan_terakhir') }}">
                            @if ($errors->has('pendidikan_terakhir'))
                                <div class="text-danger">{{ $errors->first('pendidikan_terakhir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">
                                Nomer Telepon <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="telepon"
                                placeholder="Inputkan Nomor Telepon Anda" name="no_telp" value="{{ old('no_telp', '08') }}"
                                maxlength="13" oninput="validateTelepon(this)">
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
                            <input type="text" class="form-control" id="tempat_lahir"
                                placeholder="Inputkan Tempat Lahir Anda" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                            @if ($errors->has('tempat_lahir'))
                                <div class="text-danger">{{ $errors->first('tempat_lahir') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">
                                Tanggal Lahir <span class="required" style="color: red">*</span>
                            </label>
                            <input type="date" class="form-control" id="tanggal_lahir"
                                placeholder="Inputkan Tanggal Lahir Anda" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                            @if ($errors->has('tanggal_lahir'))
                                <div class="text-danger">{{ $errors->first('tanggal_lahir') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="agama" class="form-label">
                                Agama <span class="required" style="color: red">*</span>
                            </label>
                            <select class="form-control" name="agama" id="agama">
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            </select>
                            @if ($errors->has('agama'))
                                <div class="text-danger">{{ $errors->first('agama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">
                                Nama Ibu <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_ibu"
                                placeholder="Inputkan Nama Ibu Anda" name="nama_ibu" value="{{ old('nama_ibu') }}">
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
                                <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>
                                    Menikah
                                </option>
                                <option value="Belum Menikah"
                                    {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>
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
                                name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat <span class="required" style="color: red">*</span>
                            </label>
                            <input type="text" class="form-control" id="alamat" placeholder="Inputkan Alamat Anda"
                                name="alamat" value="{{ old('alamat') }}">
                            @if ($errors->has('alamat'))
                                <div class="text-danger">{{ $errors->first('alamat') }}</div>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const teleponInput = document.getElementById('telepon');
            // Set default value
            teleponInput.value = '08';
            teleponInput.removeAttribute('readonly');
        });

        function validateTelepon(input) {
            // Always starts with '08'
            if (!input.value.startsWith('08')) {
                input.value = '08';
            }

            // Ensure only 10-11 characters after '08'
            const maxLength = 13; // Includes '08' + 10/11 characters
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        }
    </script>
@endsection
