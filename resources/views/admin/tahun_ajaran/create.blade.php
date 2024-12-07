<div class="modal fade" id="modal-tambah-data-tahun_ajaran" tabindex="-1"
    aria-labelledby="modal-tambah-data-tahun_ajaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-data-tahun_ajaran">Tambah Data Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('save-tahun_ajaran') }}" method="POST">
                        @csrf

                        <!-- Tahun Ajaran -->
                        <div class="form-group">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text"
                                class="form-control @error('tahun_ajaran', 'tambahBag') is-invalid @enderror"
                                id="tahun_ajaran" placeholder="Inputkan Tahun Ajaran Anda" name="tahun_ajaran"
                                value="{{ old('tahun_ajaran') }}">
                            @error('tahun_ajaran', 'tambahBag')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="semester" class="form-label">Tahun Ajaran</label>
                            <input type="text"
                                class="form-control @error('semester', 'tambahBag') is-invalid @enderror" id="semester"
                                placeholder="Inputkan Tahun Ajaran Anda" name="semester" value="{{ old('semester') }}">
                            @error('semester', 'tambahBag')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->tambahBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-tambah-data-tahun_ajaran').modal('show');
        });
    </script>
@endif
