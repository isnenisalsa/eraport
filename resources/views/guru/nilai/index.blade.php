@extends('layouts.template')
@section('content')
    <div class="container ">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $pembelajaran->first()->mapel->mata_pelajaran }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $pembelajaran->first()->kelas->nama_kelas }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $pembelajaran->first()->guru->nama }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center" style="height: 50vh; overflow-y: scroll; overflow-x: scroll">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title ">Daftar Nilai Siswa</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.nilai') }}" method="POST">
                            @csrf
                            <table class="table table-bordered table-striped text-center table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        @foreach ($tupel as $item)
                                            <th>{{ $item->nama_tupel }}</th>
                                        @endforeach
                                        <th>UTS</th>
                                        <th>UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            <td>{{ $item->siswa->nama }}</td>
                                            @foreach ($tupel as $subject)
                                                <td>
                                                    <input type="hidden"
                                                        name="nilai[{{ $item->siswa_id }}][{{ $subject->id }}][siswa_id]"
                                                        value="{{ $item->siswa_id }}">
                                                    <input type="text"
                                                        name="nilai[{{ $item->siswa_id }}][{{ $subject->id }}][nilai_uts]"
                                                        value="{{ old('nilai.' . $item->siswa_id . '.' . $subject->id . '.nilai_uts') }}">
                                                    <input type="text"
                                                        name="nilai[{{ $item->siswa_id }}][{{ $subject->id }}][nilai_uas]"
                                                        value="{{ old('nilai.' . $item->siswa_id . '.' . $subject->id . '.nilai_uas') }}">
                                                </td>
                                            @endforeach
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
@endsection
