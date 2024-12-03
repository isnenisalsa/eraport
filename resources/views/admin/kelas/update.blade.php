@if ($errors->editBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-edit{{ old('kode_kelas') }}').modal('show');
        });
    </script>
@endif

@foreach ($kelas as $item)
<div class="modal fade" id="modal-edit{{ $item->kode_kelas }}" tabindex="-1" aria-labelledby="modal-editLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-kelas', $item->kode_kelas) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Kode Kelas -->
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input type="text" name="kode_kelas" id="kode_kelas"
                            class="form-control" value="{{ old('kode_kelas', $item->kode_kelas) }}" readonly>
                    </div>

                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas"
                            class="form-control @error('nama_kelas', 'editBag') is-invalid @enderror"
                            value="{{ old('nama_kelas', $item->nama_kelas) }}">
                        @error('nama_kelas', 'editBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Wali Kelas -->
                    <div class="form-group">
                        <label for="guru_nik">Wali Kelas</label>
                        <select name="guru_nik" id="guru_nik"
                            class="form-control @error('guru_nik', 'editBag') is-invalid @enderror">
                            <option value="">Pilih Guru</option>
                            @foreach ($guru as $guruItem)
                                <option value="{{ $guruItem->nik }}"
                                    {{ old('guru_nik', $item->guru_nik) == $guruItem->nik ? 'selected' : '' }}>
                                    {{ $guruItem->nama }}</option>
                            @endforeach
                        </select>
                        @error('guru_nik', 'editBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id"
                            class="form-control @error('tahun_ajaran_id', 'editBag') is-invalid @enderror">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahun as $tahunItem)
                                <option value="{{ $tahunItem->id }}"
                                    {{ old('tahun_ajaran_id', $item->tahun_ajaran_id) == $tahunItem->id ? 'selected' : '' }}>
                                    {{ $tahunItem->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id', 'editBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Checkbox Terms -->
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input @error('terms', 'editBag') is-invalid @enderror"
                            id="terms{{ $item->kode_kelas }}" name="terms">
                        <label class="form-check-label" for="terms{{ $item->kode_kelas }}">Saya yakin sudah mengisi dengan benar</label>
                        @error('terms', 'editBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach