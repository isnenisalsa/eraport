{{-- @extends('layouts.template')
@section('content')

    <div class="container ">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->first()->mapel->mata_pelajaran }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->first()->kelas->nama_kelas }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">:</th>
                            <th scope="col">{{ $data->first()->guru->nama }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center" style="height: 50vh; overflow-y: scroll;">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <form method="get">
                        <button type="submit" name="showModal" value="1" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-tambah-data-pertemuan">
                            <i class="far fa-plus-square fa-lg"></i> Pertemuan
                        </button>
                        </form>
                    </div>


    <!-- Tabel Absensi -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">NIS</th>
                    <th rowspan="2">Nama Siswa</th>
                    <th rowspan="2">L/P</th>
                    <th colspan="{{ count($pertemuan) }}">Pertemuan Ke</th>
                    <th colspan="5">Jumlah</th>
                </tr>
                <tr>
                    @foreach ($pertemuan as $key => $status)
                        <th>{{ $key }}</th>
                    @endforeach
                    <th>H</th>
                    <th>S</th>
                    <th>I</th>
                    <th>A</th>
                    <th>T</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->jenis_kelamin }}</td>
                    @foreach ($pertemuan as $statuses)
                        
                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap and FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush --}}
