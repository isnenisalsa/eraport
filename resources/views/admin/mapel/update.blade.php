@if ($errors->editBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-edit{{ $item->kode_mapel }}').modal('show');
        });
    </script>
@endif
@foreach ($mapel as $item)
    <div class="modal fade" id="modal-edit{{ $item->kode_mapel }}" tabindex="-1" aria-labelledby="modal-editLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-mapel', $item->kode_mapel) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode_mapel">Kode Mapel</label>
                            <input type="text" name="kode_mapel" class="form-control" value="{{ $item->kode_mapel }}"
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" class="form-control"
                                value="{{ $item->mata_pelajaran }}" required>
                        </div>
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms">
                            <label class="form-check-label" for="exampleCheck1">Saya Yakin Sudah Mengisi Dengan
                                Benar</label>
                        </div>
                        @if ($errors->editBag->has('terms'))
                            <small class="text-danger">{{ $errors->editBag->first('terms') }}</small>
                        @endif
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
