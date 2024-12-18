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
                    <!-- ID Pembelajaran -->
                    <div class="form-group">
                        <label for="id_pembelajaran">Kode Pembelajaran</label>
                        <input type="text" name="id_pembelajaran" id="id_pembelajaran"
                            class="form-control @error('id_pembelajaran', 'tambahBag') is-invalid @enderror"
                            value="{{ old('id_pembelajaran') }}" placeholder="Inputkan Kode Pembelajaran">
                        @error('id_pembelajaran', 'tambahBag')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <select name="mata_pelajaran"
                            class="form-control @error('mata_pelajaran', 'tambahBag') is-invalid @enderror">
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
                        <label for="nama_kelas">Nama Kelas</label>
                        <select name="nama_kelas"
                            class="form-control @error('nama_kelas', 'tambahBag') is-invalid @enderror">
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
                            class="form-control @error('nama_guru', 'tambahBag') is-invalid @enderror">
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
