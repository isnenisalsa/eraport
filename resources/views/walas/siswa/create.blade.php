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
                    <form action="{{ route('save-siswa_kelas', $kelas_id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="siswa_id">Daftar Siswa</label>
                            <select name="siswa_id[]" class="form-control" id="siswa_id" multiple>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->nis }}">{{ $item->nis }} - {{ $item->nama }}
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
@push('js')
    <script>
        $(document).ready(function() {
            $('#siswa_id').select2({
                placeholder: 'Pilih siswa...',
                allowClear: true,
                closeOnSelect: false,
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
