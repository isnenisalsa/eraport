@if ($errors->editBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-edit{{ $eskul->first()->id }}').modal('show');
        });
    </script>
@endif

@foreach ($eskul as $item)
    <div class="modal fade" id="modal-edit{{ $item->id }}" tabindex="-1" aria-labelledby="modal-editLabel"
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
                    <form action="{{ route('eskul.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Kode Kelas -->

                        <!-- Nama Kelas -->
                        <div class="form-group">
                            <label for="nama_eskul">Nama Ekstrakurikuler</label>
                            <input type="text" name="nama_eskul" id="nama_eskul"
                                class="form-control @error('nama_eskul', 'editBag') is-invalid @enderror"
                                value="{{ old('nama_eskul', $item->nama_eskul) }}">
                            @error('nama_eskul', 'editBag')
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
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" name="tempat" id="tempat"
                                class="form-control @error('tempat', 'editBag') is-invalid @enderror"
                                value="{{ old('tempat', $item->tempat) }}">
                            @error('tempat', 'editBag')
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
