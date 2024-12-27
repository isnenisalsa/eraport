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
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row justify-content-center" style="height: 50vh; overflow-y: scroll; overflow-x: scroll">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-warning btn-sm" id="btn-edit-nilai" type="button">Edit Nilai</button>
                        <a href="{{ route('capel.index', ['id_pembelajaran' => $id, 'tahun_ajaran_id' => $tahun_ajaran_id]) }}"
                            class="btn btn-success btn-sm float-right">Kelola Tujuan Pembelajaran</a> &nbsp;
                    </div>
                    <div id="edit-message" class="alert alert-info" style="display: none;">
                        Anda sudah bisa mengedit
                    </div>
                    <div id="edit-error-message" class="alert alert-danger" style="display: none;">
                        Anda tidak bisa mengedit
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.nilai') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pembelajaran_id" value="{{ $id }}">
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}">
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama Siswa</th>
                                        @foreach ($groupedCapel as $lingkup => $capels)
                                            <th colspan="{{ count($capels) }}">{{ $lingkup }}</th>
                                        @endforeach
                                        <th rowspan="2">NA Sumatif</th> <!-- Tambahkan kolom rata-rata capel -->
                                        <th rowspan="2">Non Tes</th>
                                        <th rowspan="2">Tes</th>
                                        <th rowspan="2">Na Sumatif Akhir Semester</th>
                                        <th rowspan="2">Nilai Rapor</th> <!-- Tambahkan kolom untuk nilai rapor -->
                                    </tr>
                                    <tr class="text-center">
                                        @foreach ($groupedCapel as $capels)
                                            @foreach ($capels as $capelItem)
                                                <th>{{ $capelItem->nama_capel }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($siswa as $index => $item)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $item->siswa->nama }}
                                                <input type="hidden" name="siswa[{{ $index }}][id]"
                                                    value="{{ $item->id }}">
                                            </td>
                                            @php
                                                $totalNilai = 0; // Menyimpan total nilai capel
                                                $jumlahcapel = count($capel); // Jumlah capel
                                            @endphp
                                            @foreach ($capel as $capelIndex => $capelItem)
                                                <td>
                                                    @php
                                                        $nilaiItem = $nilai->firstWhere(function ($value) use (
                                                            $item,
                                                            $capelItem,
                                                        ) {
                                                            return $value->siswa_id == $item->id &&
                                                                $value->capel_id == $capelItem->id;
                                                        });
                                                        $nilaicapel = $nilaiItem ? $nilaiItem->nilai : 0;
                                                        $totalNilai += $nilaicapel; // Tambahkan nilai ke total
                                                    @endphp
                                                    <input type="text"
                                                        name="siswa[{{ $index }}][capel][{{ $capelIndex }}][nilai]"
                                                        class="form-control" value="{{ $nilaicapel }}" readonly
                                                        style="width: 80px">
                                                    <input type="hidden"
                                                        name="siswa[{{ $index }}][capel][{{ $capelIndex }}][id]"
                                                        value="{{ $capelItem->id }}" style="width: 80px">

                                                    @error("siswa.{$index}.capel.{$capelIndex}.nilai")
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            @endforeach
                                            <td>
                                                @php
                                                    $rataRatacapel = $jumlahcapel > 0 ? $totalNilai / $jumlahcapel : 0;
                                                @endphp
                                                <input type="text" class="form-control"
                                                    value="{{ number_format($rataRatacapel, 2) }}" readonly
                                                    style="width: 80px">
                                                <input type="hidden" name="siswa[{{ $index }}][rata_rata_capel]"
                                                    value="{{ $rataRatacapel }}">
                                            </td>
                                            <td>
                                                @php
                                                    $utsItem = $nilai->firstWhere(function ($value) use ($item) {
                                                        return $value->siswa_id == $item->id &&
                                                            $value->capel_id == null;
                                                    });
                                                    $utsNilai = $utsItem ? $utsItem->uts : 0;
                                                @endphp
                                                <input type="text" name="siswa[{{ $index }}][uts]"
                                                    class="form-control" value="{{ $utsNilai }}" style="width: 80px"
                                                    readonly>
                                                @error("siswa.{$index}.uts")
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                @php
                                                    $uasItem = $nilai->firstWhere(function ($value) use ($item) {
                                                        return $value->siswa_id == $item->id &&
                                                            $value->capel_id == null;
                                                    });
                                                    $uasNilai = $uasItem ? $uasItem->uas : 0;
                                                @endphp
                                                <input type="text" name="siswa[{{ $index }}][uas]"
                                                    class="form-control" value="{{ $uasNilai }}" style="width: 80px"
                                                    readonly>
                                                @error("siswa.{$index}.uas")
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                @php
                                                    $rataRataUTSUAS = ($utsNilai + $uasNilai) / 2;
                                                @endphp
                                                <input type="text" class="form-control"
                                                    value="{{ number_format($rataRataUTSUAS, 2) }}" readonly
                                                    style="width: 80px">
                                                <input type="hidden" name="siswa[{{ $index }}][rata_rata_uts_uas]"
                                                    value="{{ $rataRataUTSUAS }}">
                                            </td>
                                            <td>
                                                @php
                                                    // Menghitung nilai rapor dengan pembulatan
                                                    $nilaiRapor = ($rataRatacapel + $rataRataUTSUAS) / 2;
                                                    $nilaiRapor = round($nilaiRapor); // Dibulatkan ke angka terdekat
                                                @endphp
                                                <input type="text" class="form-control" value="{{ $nilaiRapor }}"
                                                    readonly style="width: 80px">
                                                <input type="hidden" name="siswa[{{ $index }}][nilai_rapor]"
                                                    value="{{ $nilaiRapor }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
