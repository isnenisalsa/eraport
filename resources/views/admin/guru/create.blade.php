@extends('layouts.template')
@section('content')
    <div class="card">
        <h5 class="card-header">Tambah Data Guru</h5>
        <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
            <form method="POST" action="{{ route('save') }}">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" placeholder="Inputkan NIK Anda"
                                name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">Pilih</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Inputkan Nama Anda"
                                name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Inputkan Jabatan Anda"
                                name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikan"
                                placeholder="Inputkan Pendidikan Terakhir Anda" name="pendidikan_terakhir" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">No Telepon</label>
                            <input type="number" class="form-control" id="telepon"
                                placeholder="Inputkan Nomor Telepon Anda" name="no_telp" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" placeholder="Inputkan Alamat Anda"
                                name="alamat" required>
                        </div>

                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir"
                                placeholder="Inputkan Tempat Lahir Anda" name="tempat_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir"
                                placeholder="Inputkan Tanggal Lahir Anda" name="tanggal_lahir" required>
                        </div>

                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" placeholder="Inputkan Agama Anda"
                                name="agama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu " class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu"
                                placeholder="Inputkan Nama Ibu Anda" name="nama_ibu" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <input type="text" class="form-control" id="status_perkawinan"
                                placeholder="Inputkan Status Perkawinan Anda" name="status_perkawinan" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Inputkan Email Anda"
                                name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="roles_id" class="form-label">Roles ID</label>
                            <input type="text" class="form-control" id="roles_id"
                                placeholder="Inputkan Roles ID Anda" name="roles_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username"
                                placeholder="Inputkan Username Anda" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="Inputkan Password Anda" name="password" required>
                        </div>
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan Benar</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
