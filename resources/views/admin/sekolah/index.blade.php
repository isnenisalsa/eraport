@extends('layouts.template')
@section('content')
    <div class="card card-blue">
        <h5 class="card-header">Data Sekolah</h5>

        <div class="card-body" style="height: 60vh; overflow-y: scroll">
            <form method="POST" action="{{ route('sekolah.save') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $sekolah->id ?? '' }}">

                <!-- Nama Sekolah -->
                <div class="form-group row">
                    <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Sekolah</label>
                    <div class="col-md-8">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" value="{{ old('nama', $sekolah->nama ?? '') }}" required autocomplete="nama"
                            autofocus>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- NPSN -->
                <div class="form-group row">
                    <label for="npsn" class="col-md-4 col-form-label text-md-right">NPSN</label>
                    <div class="col-md-8">
                        <input id="npsn" type="text" class="form-control @error('npsn') is-invalid @enderror"
                            name="npsn" value="{{ old('npsn', $sekolah->npsn ?? '') }}" autocomplete="npsn">
                        @error('npsn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- NSS -->
                <div class="form-group row">
                    <label for="nss" class="col-md-4 col-form-label text-md-right">NSS</label>
                    <div class="col-md-8">
                        <input id="nss" type="text" class="form-control @error('nss') is-invalid @enderror"
                            name="nss" value="{{ old('nss', $sekolah->nss ?? '') }}" autocomplete="nss">
                        @error('nss')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="form-group row">
                    <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                    <div class="col-md-8">
                        <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                            autocomplete="alamat">{{ old('alamat', $sekolah->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Desa -->
                <div class="form-group row">
                    <label for="desa" class="col-md-4 col-form-label text-md-right">Desa</label>
                    <div class="col-md-8">
                        <input id="desa" type="text" class="form-control @error('desa') is-invalid @enderror"
                            name="desa" value="{{ old('desa', $sekolah->desa ?? '') }}" autocomplete="desa">
                        @error('desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Kecamatan -->
                <div class="form-group row">
                    <label for="kecamatan" class="col-md-4 col-form-label text-md-right">Kecamatan</label>
                    <div class="col-md-8">
                        <input id="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                            name="kecamatan" value="{{ old('kecamatan', $sekolah->kecamatan ?? '') }}"
                            autocomplete="kecamatan">
                        @error('kecamatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Kabupaten -->
                <div class="form-group row">
                    <label for="kabupaten" class="col-md-4 col-form-label text-md-right">Kabupaten</label>
                    <div class="col-md-8">
                        <input id="kabupaten" type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                            name="kabupaten" value="{{ old('kabupaten', $sekolah->kabupaten ?? '') }}"
                            autocomplete="kabupaten">
                        @error('kabupaten')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Provinsi -->
                <div class="form-group row">
                    <label for="provinsi" class="col-md-4 col-form-label text-md-right">Provinsi</label>
                    <div class="col-md-8">
                        <input id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror"
                            name="provinsi" value="{{ old('provinsi', $sekolah->provinsi ?? '') }}"
                            autocomplete="provinsi">
                        @error('provinsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Nama Kepala Sekolah -->
                <div class="form-group row">
                    <label for="nama_kepsek" class="col-md-4 col-form-label text-md-right">Nama Kepala Sekolah</label>
                    <div class="col-md-8">
                        <input id="nama_kepsek" type="text"
                            class="form-control @error('nama_kepsek') is-invalid @enderror" name="nama_kepsek"
                            value="{{ old('nama_kepsek', $sekolah->nama_kepsek ?? '') }}" autocomplete="nama_kepsek">
                        @error('nama_kepsek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- NIP Kepala Sekolah -->
                <div class="form-group row">
                    <label for="nip_kepsek" class="col-md-4 col-form-label text-md-right">NIP Kepala Sekolah</label>
                    <div class="col-md-8">
                        <input id="nip_kepsek" type="text"
                            class="form-control @error('nip_kepsek') is-invalid @enderror" name="nip_kepsek"
                            value="{{ old('nip_kepsek', $sekolah->nip_kepsek ?? '') }}" autocomplete="nip_kepsek">
                        @error('nip_kepsek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
