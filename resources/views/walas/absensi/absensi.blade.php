@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->nama_kelas }}</th> <!-- Langsung akses nama_kelas -->
                        </tr>
                        <tr>
                            <th scope="col">Wali Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->guru->nama ?? 'Tidak Ditemukan' }}</th>
                            <!-- Langsung akses nama guru -->
                        </tr>
                        <tr>
                            <th scope="col">Semester</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $semester }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Absensi - {{ $kelas->nama_kelas }}</div>
                    <div class="card-body">
                        <form
                            action="{{ route('update.absensi', ['kode_kelas' => $kelas->kode_kelas, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                            method="POST">
                            @csrf
                            <table class="table table-bordered table-striped table-responsive-xl">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Sakit</th>
                                        <th>Izin</th>
                                        <th>Alfa</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($siswa as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->siswa->nama ?? 'Nama Tidak Ditemukan' }}</td>
                                            <!-- Mengakses nama siswa -->
                                            <td>
                                                <input type="hidden" name="siswa[{{ $key }}][id]"
                                                    value="{{ $item->id }}">
                                                <input type="number" name="siswa[{{ $key }}][sakit]"
                                                    class="form-control" min="0"
                                                    value="{{ old('siswa.' . $key . '.sakit', $item->absensi->sakit ?? 0) }}"
                                                    style="width: 80px">
                                            </td>
                                            <td>
                                                <input type="number" name="siswa[{{ $key }}][izin]"
                                                    class="form-control" min="0"
                                                    value="{{ old('siswa.' . $key . '.izin', $item->absensi->izin ?? 0) }}"
                                                    style="width: 80px">
                                            </td>
                                            <td>
                                                <input type="number" name="siswa[{{ $key }}][alfa]"
                                                    class="form-control " min="0"
                                                    value="{{ old('siswa.' . $key . '.alfa', $item->absensi->alfa ?? 0) }}"
                                                    style="width: 80px">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
