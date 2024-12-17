@extends('layouts.template')
@section('content')
    <div class="container mt-1">
        <div class="row">
            <!-- Kartu Profil -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Profile Guru</div>
                    <div class="card-body text-center">
                        <i class="mb-3 fas fa-user-circle fa-5x" width="100"></i>
                        <div class="mt-2">
                            <h4 class="card-text text-center fw-bold">{{ $user->nama }}</h4>
                            <p class="card-text text-center fw-bold">Jabatan: {{ $user->jabatan }}</p>
                        </div>
                        <form action="{{ route('profile.update', $user->nik) }}" method="POST">
                            @csrf
                            <ul class="list-group text-start mt-3">
                                <li class="list-group-item">
                                    <label for="username" class="fw-bold">Username:</label>
                                    <input type="text" name="username" id="username" class="form-control mt-2"
                                        value="{{ $user->username }}" required>
                                    <label for="email" class="fw-bold mt-2">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control mt-2"
                                        value="{{ $user->email }}" required>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Form Edit -->
            <div class="col-md-8 mt-n1">
                <div class="card shadow-sm">
                    <div class="card-header bg-light border-bottom">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ request('tab') == null || request('tab') == 'profile' ? 'active' : '' }}" 
                                   href="{{ route('profile.show', ['tab' => 'profile']) }}">
                                   Edit Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('tab') == 'edit-akun' ? 'active' : '' }}" 
                                   href="{{ route('profile.show', ['tab' => 'edit-akun']) }}">
                                   Edit Akun
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab Edit Profil -->
                            <div class="tab-pane fade {{ request('tab') == null || request('tab') == 'profile' ? 'show active' : '' }}" id="profile">
                                <h5 class="text-center mb-4">Form Edit Profil</h5>
                                <form action="{{ route('profile.update', $user->nik) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Nama </label>
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                value="{{ old('nama', $user->nama) }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                                <option value="laki-laki"
                                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="perempuan"
                                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="no_telp" class="form-label">No Telepon</label>
                                            <input type="text" id="no_telp" name="no_telp" class="form-control"
                                                value="{{ old('no_telp', $user->no_telp) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 mt-3">Simpan</button>
                                </form>
                            </div>

                            <!-- Tab Edit Akun -->
                            <div class="tab-content">
                                <div class="tab-pane fade {{ request('tab') == null || request('tab') == 'edit-profil' ? 'show active' : '' }}" id="edit-profil">
                                    <!-- Form Edit Profil -->
                                </div>
                            
                                <div class="tab-pane fade {{ request('tab') == 'edit-akun' ? 'show active' : '' }}" id="edit-akun">
                                    <h5 class="text-center mb-4">Form Edit Akun</h5>
                                    <form action="{{ route('profile.account', $user->nik) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
                                                @if ($errors->has('username'))
                                                <div class="text-danger">{{ $errors->first('username') }}</div>
                                            @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                                                @if ($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" id="password" name="password" class="form-control">
                                                @if ($errors->has('password'))
                                                <div class="text-danger">{{ $errors->first('password') }}</div>
                                            @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success w-100 mt-3">Simpan Akun</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function activateTabFromHash() {
                const hash = window.location.hash;
                if (hash) {
                    const tabLink = document.querySelector(`.nav-link[href="${hash}"]`);
                    if (tabLink) {
                        $(tabLink).tab('show'); // Gunakan Bootstrap 4.6 API
                    }
                }
            }

            // Tampilkan tab sesuai hash URL saat halaman dimuat
            activateTabFromHash();

            // Perbarui hash URL ketika tab diklik
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    const newHash = this.getAttribute('href');
                    history.replaceState(null, '', newHash);
                });
            });

            // Dengarkan perubahan hash URL
            window.addEventListener('hashchange', activateTabFromHash);
        });
    </script>
@endsection
