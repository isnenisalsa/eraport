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
                        <ul class="list-group text-start mt-3">
                            <li class="list-group-item">
                                <label for="username" class="fw-bold">Username:</label>
                                <input type="text" name="username" id="username" class="form-control mt-2"
                                    value="{{ $user->username }}" readonly>
                                <label for="email" class="fw-bold mt-2">Email:</label>
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
                            <div class="tab-pane fade {{ request('tab') == null || request('tab') == 'profile' ? 'show active' : '' }}"
                                id="profile">
                                <h5 class="text-center mb-4">Form Edit Profil</h5>
                                <form action="{{ route('profile.update', $user->nik) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $user->nama) }}" required readonly>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="no_telp" class="form-label">No Telepon</label>
                                            <input type="text" id="no_telp" name="no_telp"
                                                class="form-control @error('no_telp') is-invalid @enderror"
                                                value="{{ old('no_telp', $user->no_telp) }}" maxlength="13">
                                            @error('no_telp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                                    <form id="passwordForm" action="{{ route('profile.account', $user->nik) }}"
                                        method="POST">
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
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password"
                                                        class="form-control">
                                                    <span class="input-group-text" id="toggle-password"
                                                        style="cursor: pointer;">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control">
                                                <div id="password_confirmation_feedback" class="invalid-feedback">
                                                    Password Baru dan Konfirmasi Password Tidak Cocok.
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100 mt-3">Simpan Akun</button>
                                    </form>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const passwordInput = document.getElementById('password');
                                            const passwordConfirmationInput = document.getElementById('password_confirmation');
                                            const feedbackElement = document.getElementById('password_confirmation_feedback');
                                            const passwordForm = document.getElementById('passwordForm');

                                            function validatePasswords() {
                                                const password = passwordInput.value;
                                                const confirmation = passwordConfirmationInput.value;

                                                // Validasi case-sensitive
                                                if (password !== confirmation) {
                                                    // Tambahkan kelas `is-invalid` untuk menandai input bermasalah
                                                    passwordConfirmationInput.classList.add('is-invalid');
                                                    feedbackElement.style.display = 'block'; // Tampilkan pesan kesalahan
                                                    return false;
                                                } else {
                                                    // Hapus kelas `is-invalid` jika cocok
                                                    passwordConfirmationInput.classList.remove('is-invalid');
                                                    feedbackElement.style.display = 'none'; // Sembunyikan pesan kesalahan
                                                    return true;
                                                }
                                            }

                                            // Tambahkan event listener untuk input perubahan
                                            passwordConfirmationInput.addEventListener('input', validatePasswords);

                                            // Validasi saat formulir dikirimkan
                                            passwordForm.addEventListener('submit', function(e) {
                                                let isValid = true;
                                                if (!validatePasswords()) {
                                                    isValid = false; // Menandai form sebagai tidak valid
                                                }

                                                // Menampilkan pesan error dari server
                                                const inputs = passwordForm.querySelectorAll('input');
                                                inputs.forEach(function(input) {
                                                    if (input.classList.contains('is-invalid') || input.value === '') {
                                                        const errorMessage = input.nextElementSibling;
                                                        if (errorMessage && errorMessage.classList.contains('text-danger')) {
                                                            errorMessage.style.display = 'block';
                                                        }
                                                    }
                                                });

                                                if (!isValid) {
                                                    e.preventDefault(); // Batalkan pengiriman formulir jika tidak valid
                                                }
                                            });

                                            // Toggle Visibility untuk Password
                                            const togglePassword = document.getElementById('toggle-password');
                                            if (togglePassword) {
                                                const eyeIcon = togglePassword.querySelector('i');
                                                togglePassword.addEventListener('click', function() {
                                                    const isPasswordVisible = passwordInput.type === 'password';
                                                    passwordInput.type = isPasswordVisible ? 'text' : 'password';

                                                    // Update ikon
                                                    eyeIcon.classList.toggle('fa-eye');
                                                    eyeIcon.classList.toggle('fa-eye-slash');
                                                });
                                            }
                                        });
                                    </script>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
