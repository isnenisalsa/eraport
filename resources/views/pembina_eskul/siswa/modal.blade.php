<div class="modal fade" id="modal-tambah-data-siswa" tabindex="-1" aria-labelledby="modal-tambah-data-siswaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('save.eskul.siswa', $id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="siswa_id">Siswa</label>
                            <select name="siswa_id" class="form-control select2" style="width: 100%; height: 120px"
                                id="siswa_id" required>
                                <option value="">- Pilih Siswa -</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">{{ $item->siswa->nis }} -
                                        {{ $item->siswa->nama }} - {{ $item->kelas->nama_kelas }} -
                                        {{ $item->kelas->tahun_ajarans->tahun_ajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class=" btn btn-tambah btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
