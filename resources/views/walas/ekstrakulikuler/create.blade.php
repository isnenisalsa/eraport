<style>
    .select2-scrollable .select2-results {
        max-height: 100px;
        overflow-y: scroll;
    }

    .select2-container {
        z-index: 1050 !important;
    }
</style>
<div class="modal fade" id="modal-tambah-data-eskul" tabindex="-1" aria-labelledby="modal-tambah-data-siswaLabel"
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
                    <form action="{{ route('save.nilai.eskul', $id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="siswa_id">Siswa</label>
                            <select name="siswa_id" class="form-control select2"
                                style="width: 100%; height: 50px; overflow-y: scroll" id="siswa_id" required>
                                <option value="">- Pilih Siswa -</option>
                                @foreach ($siswa_kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->siswa->nis }} -
                                        {{ $item->siswa->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eskul_id">ekstrakulikuler</label>
                            <select name="eskul_id" class="form-control"
                                style="width: 100%; height: 50px; overflow-y: scroll" id="eskul_id" required>
                                <option value="">- Pilih ekstrakulikuler -</option>
                                @foreach ($eskul as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_eskul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="form-label">keterangan</label>
                            <input type="text" class="form-control" id="keterangan"
                                placeholder="Inputkan keterangan Anda" name="keterangan"
                                value="{{ old('keterangan') }}">
                            @if ($errors->has('keterangan'))
                                <div class="text-danger">{{ $errors->first('keterangan') }}</div>
                            @endif
                        </div>
                        <button type="submit" class=" btn btn-tambah btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
