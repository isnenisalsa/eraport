<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard Admin -->
            @if (auth('web')->check() &&
                    auth()->user()->roles->pluck('nama')->intersect(['admin', 'guru', 'walas'])->isNotEmpty())
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Dashboard</p>
                    </a>
                </li>
            @endif
            {{-- siswa --}}
            @if (Auth::guard('siswa')->check())
                <li class="nav-item">
                    <a href="{{ url('/dashboard/siswa') }}"
                        class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Dashboard Siswa</p>
                    </a>
                </li>
            @endif
            @if (Auth::guard('siswa')->check())
                <li class="nav-item">
                    <a href="{{ url('cetak/rapor/siswa/kelas') }}"
                        class="nav-link {{ $activeMenu == 'Kelas Siswa' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-satellite" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Data Kelas</p>
                    </a>
                </li>
            @endif
            <!-- Menu Wali Kelas -->
            @if (auth('web')->check() && auth()->user()->roles->contains('nama', 'walas'))
                <li
                    class="nav-item has-treeview bg-gray-900 {{ in_array($activeMenu, ['Data Kelas', 'Data Absensi', 'Ekstrakurikuler', 'Data Nilai Akhir', 'Cetak Rapor']) ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ in_array($activeMenu, ['Data Siswa', 'Ekstrakurikuler', 'Data Nilai Akhir', 'Cetak Rapor']) ? 'active' : '' }}">
                        <i class="fas fa-solid fa-school" style="color: black"></i>
                        <p style="color: black">&nbsp; Wali Kelas <i class="right fas fa-angle-left"
                                style="color: black"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/kelas/walas') }}"
                                class="nav-link {{ $activeMenu == 'Data Kelas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('absensi/kelas/') }}"
                                class="nav-link {{ $activeMenu == 'Data Absensi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-check" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Absensi Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('eskul/kelas') }}"
                                class="nav-link {{ $activeMenu == 'Ekstrakurikuler' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-award" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)"> Data Ekstrakurikuler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kelas/walas/nilai') }}"
                                class="nav-link {{ $activeMenu == 'Data Nilai Akhir' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-invoice" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Data Nilai Akhir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cetak/rapor/walas/kelas') }}"
                                class="nav-link {{ $activeMenu == 'Cetak Rapor' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-print" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Cetak Rapor</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Menu Guru Mapel -->
            @if (auth('web')->check() && auth()->user()->roles->contains('nama', 'guru'))
                @php
                    // Cek apakah guru tersebut mengampu kelas (misalnya dengan cek kelas yang dia ampu)
                    $guru = auth()->user();
                    $gurumapel = $guru->pembelajaran()->exists(); // Sesuaikan relasi dengan model yang sesuai, misal kelas yang dia ampu
                @endphp
                @if ($gurumapel)
                    <li
                        class="nav-item has-treeview bg-gray-900 {{ in_array($activeMenu, ['Data Pembelajaran']) ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ in_array($activeMenu, ['Data Pembelajaran']) ? 'active' : '' }}">
                            <i class="fas fa-solid fa-school" style="color: black"></i>
                            <p style="color: black">&nbsp; Guru Mapel <i class="right fas fa-angle-left"
                                    style="color: black"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/pembelajaran/guru') }}"
                                    class="nav-link {{ $activeMenu == 'Data Pembelajaran' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-folder" style="color: rgb(3, 3, 3)"></i>
                                    <p style="color: rgb(10, 10, 10)">Data Pembelajaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif

            <!-- Menu Admin -->
            @if (auth('web')->check() && auth()->user()->roles->contains('nama', 'admin'))
                <li
                    class="nav-item has-treeview bg-gray-900 {{ in_array($activeMenu, ['guru', 'siswa']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array($activeMenu, ['guru', 'siswa']) ? 'active' : '' }}">
                        <i class="fas fa-solid fa-users" style="color: black"></i>
                        <p style="color: black">&nbsp; Pengguna <i class="right fas fa-angle-left"
                                style="color: black"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('guru') }}"
                                class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('siswa') }}"
                                class="nav-link {{ $activeMenu == 'siswa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Siswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif




            <li
                class="nav-item has-treeview bg-gray-900 {{ in_array($activeMenu, ['Data Sekolah', 'Tahun Ajaran', 'kelas', 'mapel', 'pembelajaran', 'Ekstrakurikuler Admin']) ? 'menu-open' : '' }}">
                @if (auth('web')->check() && auth()->user()->roles->contains('nama', 'admin'))
                    <a href="#"
                        class="nav-link {{ in_array($activeMenu, ['Data Sekolah', 'Tahun Ajaran', 'kelas', 'mapel', 'pembelajaran', 'Ekstrakurikuler Admin']) ? 'active' : '' }}">
                        <i class="fas fa-solid fa-laptop" style="color: black"></i>
                        <p style="color: black">
                            &nbsp; ADMINISTRASI
                            <i class="right fas fa-angle-left" style="color: black"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('sekolah/') }}"
                                class="nav-link {{ $activeMenu == 'Data Sekolah' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tahun/ajaran') }}"
                                class="nav-link {{ $activeMenu == 'Tahun Ajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Tahun Ajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kelas') }}"
                                class="nav-link {{ $activeMenu == 'kelas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mapel') }}"
                                class="nav-link {{ $activeMenu == 'mapel' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Mapel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('pembelajaran') }}"
                                class="nav-link {{ $activeMenu == 'pembelajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Pembelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('eskul') }}"
                                class="nav-link {{ $activeMenu == 'Ekstrakurikuler Admin' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Data Ekstrakurikuler</p>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>
            @if (auth('web')->check() &&
                    auth()->user()->roles->pluck('nama')->intersect(['admin', 'guru', 'walas'])->isNotEmpty())
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}"
                        class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Profile</p>
                    </a>
                </li>
            @endif

            @if (Auth::guard('siswa')->check())
                <li class="nav-item">
                    <a href="{{ route('profile.show.siswa') }}"
                        class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Profile</p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
