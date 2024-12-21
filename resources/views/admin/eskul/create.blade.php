<div class="modal fade" id="modal-tambah-data-eskul" tabindex="-1" aria-labelledby="modal-tambah-data-eskulLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data eskul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('eskul.save') }}" method="POST">
                    @csrf

                    <!-- Nama eskul -->
                    <div class="form-group">
                        <label for="nama_eskul">Nama esktrakurikuler</label>
                        <input type="text" name="nama_eskul" id="nama_eskul"
                            class="form-control @error('nama_eskul', 'tambahBag') is-invalid @enderror"
                            value="{{ old('nama_eskul') }}">
                        @error('nama_eskul', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Wali eskul -->
                    <div class="form-group">
                        <label for="guru_nik_eskul">Pembina esktrakurikuler</label>
                        <select name="guru_nik" id="guru_nik_eskul"
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


                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" name="tempat" id="tempat"
                            class="form-control @error('tempat', 'tambahBag') is-invalid @enderror"
                            value="{{ old('tempat') }}">
                        @error('tempat', 'tambahBag')
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
            $('#modal-tambah-data-eskul').modal('show');
        });
    </script>
@endif
