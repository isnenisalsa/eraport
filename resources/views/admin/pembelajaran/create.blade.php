<div class="modal fade" id="modal-tambah-data-pembelajaran" tabindex="-1"
    aria-labelledby="modal-tambah-data-pembelajaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pembelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save-pembelajaran') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Mata Pelajaran -->
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran :</label>
                        <select name="mata_pelajaran"
                            class="form-control @error('mata_pelajaran', 'tambahBag') is-invalid @enderror"
                            id="mata_pelajaran">
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach ($mapel as $item)
                                <option value="{{ $item->kode_mapel }}"
                                    {{ old('mata_pelajaran') == $item->kode_mapel ? 'selected' : '' }}>
                                    {{ $item->mata_pelajaran }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas :</label>
                        <select name="nama_kelas"
                            class="form-control @error('nama_kelas', 'tambahBag') is-invalid @enderror" id="nama_kelas">
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $kelasitem)
                                <option value="{{ $kelasitem->kode_kelas }}"
                                    {{ old('nama_kelas') == $kelasitem->kode_kelas ? 'selected' : '' }}>
                                    {{ $kelasitem->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_kelas', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Guru Pengampu -->
                    <div class="form-group">
                        <label for="nama_guru">Guru Pengampu</label>
                        <select name="nama_guru"
                            class="form-control @error('nama_guru', 'tambahBag') is-invalid @enderror" id="nama_guru">
                            <option value="">Pilih Guru Pengampu</option>
                            @foreach ($guru as $item)
                                <option value="{{ $item->nik }}"
                                    {{ old('nama_guru') == $item->nik ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_guru', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
            </form>
            <br><br>
        </div>
    </div>
</div>
</div>
@if ($errors->tambahBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-tambah-data-pembelajaran').modal('show');
        });
    </script>
@endif
@push('js')
    <script>
        $(document).ready(function() {
            $('#mata_pelajaran').select2({
                placeholder: "Pilih Mata Pelajaran",
                dropdownParent: $('#modal-tambah-data-pembelajaran'),
                width: '100%',
                language: {
                    noResults: function() {
                        return "Tidak ada hasil ditemukan";
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#nama_kelas').select2({
                placeholder: "Pilih Kelas",
                dropdownParent: $('#modal-tambah-data-pembelajaran'),
                width: '100%',
                language: {
                    noResults: function() {
                        return "Tidak ada hasil ditemukan";
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#nama_guru').select2({
                placeholder: "Pilih Guru Pengampu",
                dropdownParent: $('#modal-tambah-data-pembelajaran'),
                width: '100%',
                language: {
                    noResults: function() {
                        return "Tidak ada hasil ditemukan";
                    }
                }
            });
        });
    </script>
@endpush
