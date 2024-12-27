@extends('layouts.template')
@section('content')
    <div class="container mt-1">
        <div class="row">
            <!-- Kartu Profil -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Profile Siswa</div>
                    <div class="card-body text-center">
                        <i class="mb-3 fas fa-user-circle fa-5x" width="100"></i>
                        <div class="mt-2">
                            <h4 class="card-text text-center fw-bold">{{ $user->nama }}</h4>
                        </div>
                        <ul class="list-group text-start mt-3">
                            <li class="list-group-item">
                                <label for="username" class="fw-bold">Username:</label>
                                <input type="text" name="username" id="username" class="form-control mt-2"
                                    value="{{ $user->username }}" readonly>
                                <label for="email" class="fw-bold">Email:</label>
                                <input type="text" name="email" id="email" class="form-control mt-2"
                                    value="{{ $user->email }}" readonly>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Edit -->
            <div class="col-md-8 mt-n1">
                <div class="card shadow-sm">
                    <div class="card-header bg-light border-bottom">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'profile' ? 'active' : '' }}"
                                    href="{{ route('profile.show.siswa', ['tab' => 'profile']) }}">
                                    Edit Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 'edit-akun' ? 'active' : '' }}"
                                    href="{{ route('profile.show.siswa', ['tab' => 'edit-akun']) }}">
                                    Edit Akun
                                </a>
                            </li>
                        </ul>


                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab Edit Profil -->
                            <div class="tab-pane fade {{ request('tab') == null || request('tab') == 'profile' ? 'show active' : '' }}"
                                id="profile">
                                <h5 class="text-center mb-4">Form Edit Profil</h5>
                                <form action="{{ route('profile.update.siswa', $user->nis) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Nama </label>
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                value="{{ old('nama', $user->nama) }}" required readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 mt-3">Simpan</button>
                                </form>
                            </div>







                            <!-- Tab Edit Akun -->
                            <div class="tab-content">
                                <div class="tab-pane fade {{ request('tab') == null || request('tab') == 'edit-profil' ? 'show active' : '' }}"
                                    id="edit-profil">
                                    <!-- Form Edit Profil -->
                                </div>
                                <div class="tab-pane fade {{ request('tab') == 'edit-akun' ? 'show active' : '' }}"
                                    id="edit-akun">
                                    <h5 class="text-center mb-4">Form Edit Akun</h5>
                                    <form action="{{ route('profile.account.siswa', $user->nis) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="username" class="form-control"
                                                    value="{{ $user->username }}">
                                                @if ($errors->has('username'))
                                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ $user->email }}">
                                                @if ($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password Baru</label>
                                                <input type="password" id="password" name="password" class="form-control">
                                                @if ($errors->has('password'))
                                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control">
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="text-danger">{{ $errors->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const passwordInput = document.getElementById('password');
                                                const passwordConfirmationInput = document.getElementById('password_confirmation');

                                                passwordConfirmationInput.addEventListener('input', function() {
                                                    const password = passwordInput.value;
                                                    const confirmation = passwordConfirmationInput.value;

                                                    if (password !== confirmation) {
                                                        passwordConfirmationInput.setCustomValidity(
                                                            'Password Baru dan Konfirmasi Password Tidak Cocok.');
                                                    } else {
                                                        passwordConfirmationInput.setCustomValidity('');
                                                    }
                                                });
                                            });
                                        </script>
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
            const hash = window.location.hash || '#profile';
            const tabLink = document.querySelector(`.nav-link[href="${hash}"]`);
            if (tabLink) {
                tabLink.click(); // Aktifkan tab berdasarkan hash
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    const newHash = this.getAttribute('href');
                    history.replaceState(null, '', newHash); // Update URL
                });
            });
        });
    </script>
@endsection
