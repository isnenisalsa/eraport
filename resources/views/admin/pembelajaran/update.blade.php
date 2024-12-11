@if ($errors->editBag->any())
    <script>
        $(document).ready(function() {
            $('#modal-edit{{ old('id_pembelajaran') }}').modal('show');
        });
    </script>
@endif

@foreach ($pembelajaran as $item)
    <div class="modal fade @if (session('editModal') == $item->id_pembelajaran || old('id_pembelajaran') == $item->id_pembelajaran) show @endif"
        id="modal-edit{{ $item->id_pembelajaran }}" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true"
        style="@if (session('editModal') == $item->id_pembelajaran || old('id_pembelajaran') == $item->id_pembelajaran) display: block; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pembelajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('update-pembelajaran', $item->id_pembelajaran) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- ID Pembelajaran -->
                        <div class="form-group">
                            <label for="id_pembelajaran">ID Pembelajaran</label>
                            <input type="text" name="id_pembelajaran" class="form-control"
                                value="{{ old('id_pembelajaran', $item->id_pembelajaran) }}" readonly>
                        </div>

                        <!-- Mata Pelajaran -->
                        <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                            <select name="mata_pelajaran"
                                class="form-control @error('mata_pelajaran', 'editBag') is-invalid @enderror">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapel as $mapelItem)
                                    <option value="{{ $mapelItem->kode_mapel }}"
                                        {{ old('mata_pelajaran', $item->mata_pelajaran) == $mapelItem->kode_mapel ? 'selected' : '' }}>
                                        {{ $mapelItem->mata_pelajaran }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran', 'editBag')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Nama Kelas -->
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <select name="nama_kelas"
                                class="form-control @error('nama_kelas', 'editBag') is-invalid @enderror" >
                                <option value="">Pilih Nama Kelas</option>
                                @foreach ($kelas as $kelasItem)
                                    <option value="{{ $kelasItem->kode_kelas }}"
                                        {{ old('nama_kelas', $item->nama_kelas) == $kelasItem->kode_kelas ? 'selected' : '' }}>
                                        {{ $kelasItem->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_kelas', 'editBag')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Guru Pengampu -->
                        <div class="form-group">
                            <label for="nama_guru">Guru Pengampu</label>
                            <select name="nama_guru"
                                class="form-control @error('nama_guru', 'editBag') is-invalid @enderror" >
                                <option value="">Pilih Guru Pengampu</option>
                                @foreach ($guru as $guruItem)
                                    <option value="{{ $guruItem->nik }}"
                                        {{ old('nama_guru', $item->nama_guru) == $guruItem->nik ? 'selected' : '' }}>
                                        {{ $guruItem->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_guru', 'editBag')
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
@endforeach
