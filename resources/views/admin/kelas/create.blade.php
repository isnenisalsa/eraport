<div class="modal fade" id="modal-tambah-data-kelas" tabindex="-1" aria-labelledby="modal-tambah-data-kelasLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-kelas') }}" method="POST">
                    @csrf
                    <!-- Kode Kelas -->
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" name="kode_kelas" id="kode_kelas"
                            class="form-control @error('kode_kelas', 'tambahBag') is-invalid @enderror"
                            value="{{ old('kode_kelas') }}">
                        @error('kode_kelas', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas"
                            class="form-control @error('nama_kelas', 'tambahBag') is-invalid @enderror"
                            value="{{ old('nama_kelas') }}">
                        @error('nama_kelas', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Wali Kelas -->
                    <div class="form-group">
                        <label for="guru_nik">Wali Kelas</label>
                        <select name="guru_nik" id="guru_nik"
                            class="form-control @error('guru_nik', 'tambahBag') is-invalid @enderror">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $item)
                                <option value="{{ $item->nik }}"
                                    {{ old('guru_nik') == $item->nik ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('guru_nik', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id[]" id="tahun_ajaran_id"
                            class="form-control @error('tahun_ajaran_id', 'tambahBag') is-invalid @enderror" multiple>
                            @foreach ($tahun as $item)
                                <option value="{{ $item->id }}"
                                    {{ is_array(old('tahun_ajaran_id')) && in_array($item->id, old('tahun_ajaran_id')) ? 'selected' : '' }}>
                                    {{ $item->tahun_ajaran }} - {{ $item->semester }}
                                </option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($errors->tambahBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-tambah-data-kelas').modal('show');
        });
    </script>
@endif
