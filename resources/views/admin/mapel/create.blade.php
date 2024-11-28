<div class="modal fade" id="modal-tambah-data-mapel" tabindex="-1" aria-labelledby="modal-tambah-data-mapelLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-data-mapelLabel">Tambah Data Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-mapel') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input type="text" name="kode_mapel" id="kode_mapel"
                            class="form-control @error('kode_mapel') is-invalid @enderror"
                            value="{{ old('kode_mapel') }}">
                        @if ($errors->tambahBag->has('kode_mapel'))
                            <small class="text-danger">{{ $errors->tambahBag->first('kode_mapel') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                            class="form-control @error('mata_pelajaran') is-invalid @enderror"
                            value="{{ old('mata_pelajaran') }}">
                        @if ($errors->tambahBag->has('mata_pelajaran'))
                            <small class="text-danger">{{ $errors->tambahBag->first('mata_pelajaran') }}</small>
                        @endif
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                            name="terms" id="terms">
                        <label class="form-check-label" for="terms">Saya Yakin Sudah Mengisi Dengan Benar</label>
                        <br>
                        @if ($errors->tambahBag->has('terms'))
                            <small class="text-danger">{{ $errors->tambahBag->first('terms') }}</small>
                        @endif
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
            $('#modal-tambah-data-mapel').modal('show');
        });
    </script>
@endif
