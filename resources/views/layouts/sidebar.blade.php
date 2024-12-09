<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Dashboard Admin -->
            @if (auth()->check() &&
                    auth()->user()->roles->pluck('nama')->intersect(['admin', 'guru', 'walas'])->isNotEmpty())
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Dashboard</p>
                    </a>
                </li>
            @endif

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
                    <a href="{{ url('cetak/rapor/siswa') }}"
                        class="nav-link {{ $activeMenu == 'Pembelajaran Siswa' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-satellite" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">Data Pembelajaran</p>
                    </a>
                </li>
            @endif
            <!-- Menu Wali Kelas -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
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
                                class="nav-link {{ $activeMenu == 'Absensi Siswa' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-check" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Absensi Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('eskul/kelas') }}"
                                class="nav-link {{ $activeMenu == 'Absensi Siswa' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-check" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)"> Data Ekstrakurikuler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kelas/walas/nilai') }}"
                                class="nav-link {{ $activeMenu == 'Data Nilai Akhir' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-archive" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Data Nilai Akhir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cetak/rapor/kelas/') }}"
                                class="nav-link {{ $activeMenu == 'Cetak Rapot' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-print" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Cetak Rapor</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Menu Guru Mapel -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'guru'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-school" style="color: black"></i>
                        <p style="color: black">&nbsp; Guru Mapel <i class="right fas fa-angle-left"
                                style="color: black"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/pembelajaran/guru') }}"
                                class="nav-link {{ $activeMenu == 'Data Pembelajaran' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Data Pembelajaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Menu Admin -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-users" style="color: black"></i>
                        <p style="color: black">&nbsp; Pengguna <i class="right fas fa-angle-left"
                                style="color: black"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('guru') }}"
                                class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('siswa') }}"
                                class="nav-link {{ $activeMenu == 'Siswa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Siswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li
                class="nav-item has-treeview bg-gray-900 {{ in_array($activeMenu, ['Data Sekolah', 'Tahun Ajaran', 'kelas', 'mapel', 'pembelajaran', 'Eskul']) ? 'menu-open' : '' }}">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                    <a href="#"
                        class="nav-link {{ in_array($activeMenu, ['Data Sekolah', 'Tahun Ajaran', 'kelas', 'mapel', 'pembelajaran', 'Eskul']) ? 'active' : '' }}">
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
                                <p style="color: black">Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tahun/ajaran') }}"
                                class="nav-link {{ $activeMenu == 'Tahun Ajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Tahun Ajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kelas') }}"
                                class="nav-link {{ $activeMenu == 'kelas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mapel') }}"
                                class="nav-link {{ $activeMenu == 'mapel' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Mapel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('pembelajaran') }}"
                                class="nav-link {{ $activeMenu == 'pembelajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Pembelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('eskul') }}"
                                class="nav-link {{ $activeMenu == 'Eskul' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Ekstrakulikuler</p>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>



            <!-- Menu Ekstrakurikuler -->
            @if (auth()->check() && auth()->user()->roles->contains('nama', 'pembina eskul'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-laptop" style="color: black"></i>
                        <p style="color: black">&nbsp; Data <i class="right fas fa-angle-left"
                                style="color: black"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('eskul/daftar') }}"
                                class="nav-link {{ $activeMenu == 'Data Siswa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('eskul/nilai') }}"
                                class="nav-link {{ $activeMenu == 'nilai' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Nilai</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
