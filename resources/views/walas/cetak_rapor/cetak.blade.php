@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-light text-white">
                    <strong>Daftar Siswa - {{ $kelas->nama_kelas }}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th style="width: 23%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->siswa->nis }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('walas.cover',$item->siswa->nis) }}" class="btn btn-danger btn-md me-2" title="Cover">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                        <a href="{{ route('walas.biodata', $item->siswa->nis) }}" class="btn btn-warning btn-md me-2" title="Lihat Biodata">
                                            <i class="fas fa-file-alt"></i> 
                                        </a>
                                        
                                        <button class="btn btn-primary btn-md" title="Cetak Rapor">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
