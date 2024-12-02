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
                            <table class="table table-bordered table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        @foreach ($tupel as $item)
                                            <th>{{ $item->nama_tupel }}</th>
                                        @endforeach
                                        <th>Rata-rata Tupel</th> <!-- Tambahkan kolom rata-rata Tupel -->
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Rata-rata UTS & UAS</th>
                                        <th>Nilai Rapor</th> <!-- Tambahkan kolom untuk nilai rapor -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $item->siswa->nama }}
                                                <input type="hidden" name="siswa[{{ $index }}][id]"
                                                    value="{{ $item->id }}">
                                            </td>
                                            @php
                                                $totalNilai = 0; // Menyimpan total nilai tupel
                                                $jumlahTupel = count($tupel); // Jumlah tupel
                                            @endphp
                                            @foreach ($tupel as $tupelIndex => $tupelItem)
                                                <td>
                                                    @php
                                                        $nilaiItem = $nilai->firstWhere(function ($value) use (
                                                            $item,
                                                            $tupelItem,
                                                        ) {
                                                            return $value->siswa_id == $item->id &&
                                                                $value->tupel_id == $tupelItem->id;
                                                        });
                                                        $nilaiTupel = $nilaiItem ? $nilaiItem->nilai : 0;
                                                        $totalNilai += $nilaiTupel; // Tambahkan nilai ke total
                                                    @endphp
                                                    <input type="text"
                                                        name="siswa[{{ $index }}][tupel][{{ $tupelIndex }}][nilai]"
                                                        class="form-control" value="{{ $nilaiTupel }}" readonly>
                                                    <input type="hidden"
                                                        name="siswa[{{ $index }}][tupel][{{ $tupelIndex }}][id]"
                                                        value="{{ $tupelItem->id }}">

                                                    @error("siswa.{$index}.tupel.{$tupelIndex}.nilai")
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            @endforeach
                                            <td>
                                                @php
                                                    $rataRataTupel = $jumlahTupel > 0 ? $totalNilai / $jumlahTupel : 0;
                                                @endphp
                                                <input type="text" class="form-control"
                                                    value="{{ number_format($rataRataTupel, 2) }}" readonly
                                                    style="width: 80px">
                                                <input type="hidden" name="siswa[{{ $index }}][rata_rata_tupel]"
                                                    value="{{ $rataRataTupel }}">
                                            </td>
                                            <td>
                                                @php
                                                    $utsItem = $nilai->firstWhere(function ($value) use ($item) {
                                                        return $value->siswa_id == $item->id &&
                                                            $value->tupel_id == null;
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
                                                            $value->tupel_id == null;
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
                                                    $nilaiRapor = ($rataRataTupel + $rataRataUTSUAS) / 2;
                                                @endphp
                                                <input type="text" class="form-control"
                                                    value="{{ number_format($nilaiRapor, 2) }}" readonly
                                                    style="width: 80px">
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
