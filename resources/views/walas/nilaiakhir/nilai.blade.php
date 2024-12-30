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
                            <th scope="col">{{ $kelas->first()->nama_kelas }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $kelas->first()->guru->nama }}</th>
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
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Nilai Rapor Siswa</h5>
                <table class="table table-striped table-bordered mt-3 table-responsive-xl">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($pembelajaran as $item)
                                <th>{{ $item->mapel->mata_pelajaran }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($siswa_kelas as $item)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                @foreach ($pembelajaran as $pelajaran)
                                    @php
                                        // Ambil nilai rapor dengan logika yang lebih jelas
                                        $nilaiRapor = $nilai
                                            ->where('siswa_id', $item->id)
                                            ->where('pembelajaran_id', $pelajaran->id_pembelajaran)
                                            ->first();
                                    @endphp
                                    <td>

                                        {{ $nilaiRapor ? $nilaiRapor->nilai_rapor : 'Belum Ada Nilai' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
