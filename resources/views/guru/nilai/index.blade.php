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
                                        <th>UTS</th>
                                        <th>UAS</th>
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
                                            @foreach ($tupel as $tupelIndex => $tupelItem)
                                                <td>
                                                    @php
                                                        // Mencari nilai untuk siswa dan tupel tertentu
                                                        $nilaiItem = $nilai->firstWhere(function ($value) use (
                                                            $item,
                                                            $tupelItem,
                                                        ) {
                                                            return $value->siswa_id == $item->id &&
                                                                $value->tupel_id == $tupelItem->id;
                                                        });
                                                    @endphp
                                                    <input type="text"
                                                        name="siswa[{{ $index }}][tupel][{{ $tupelIndex }}][nilai]"
                                                        class="form-control"
                                                        value="{{ $nilaiItem ? $nilaiItem->nilai : 0 }}" readonly>
                                                    <input type="hidden"
                                                        name="siswa[{{ $index }}][tupel][{{ $tupelIndex }}][id]"
                                                        value="{{ $tupelItem->id }}">

                                                    <!-- Menampilkan error jika ada -->
                                                    @error("siswa.{$index}.tupel.{$tupelIndex}.nilai")
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            @endforeach
                                            <td>
                                                @php
                                                    // Mencari nilai UTS dan UAS
                                                    $utsItem = $nilai->firstWhere(function ($value) use ($item) {
                                                        return $value->siswa_id == $item->id &&
                                                            $value->tupel_id == null;
                                                    });
                                                @endphp
                                                <input type="text" name="siswa[{{ $index }}][uts]"
                                                    class="form-control" value="{{ $utsItem ? $utsItem->uts : 0 }}"
                                                    style="width: 80px" readonly>
                                                <!-- Menampilkan error jika ada -->
                                                @error("siswa.{$index}.uts")
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                @php
                                                    // Mencari nilai UTS dan UAS
                                                    $uasItem = $nilai->firstWhere(function ($value) use ($item) {
                                                        return $value->siswa_id == $item->id &&
                                                            $value->tupel_id == null;
                                                    });
                                                @endphp
                                                <input type="text" name="siswa[{{ $index }}][uas]"
                                                    class="form-control" value="{{ $uasItem ? $uasItem->uas : 0 }}"
                                                    style="width: 80px" readonly>
                                                <!-- Menampilkan error jika ada -->
                                                @error("siswa.{$index}.uas")
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
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
