<div class="sidebar">
    <!-- Sidebar user (optional) -->
    &nbsp;
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                    <a href="{{ url('/dashboard/admin') }}"
                        class="nav-link  {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">
                            Dashboard
                        </p>
                    </a>
                @endif
            </li>
            <li class="nav-item has-treeview">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-school" style="color: black"></i>
                        <p style="color: black">
                            &nbsp; Wali Kelas
                            <i class="right fas fa-angle-left" style="color: black"></i>
                        </p>
                    </a>
                @endif
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/dashboard/walas') }}"
                            class="nav-link {{ $activeMenu == 'dashboard walas' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                            <p style="color: rgb(10, 10, 10)">Dashboard</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                        <li class="nav-item">
                            <a href="{{ url('/kelas/walas') }}"
                                class="nav-link  {{ $activeMenu == 'Data Kelas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">
                                    Data Kelas
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>

                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                        <li class="nav-item">
                            <a href="{{ url('/kelas/siswa') }}"
                                class="nav-link  {{ $activeMenu == 'Data Pembelajaran' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-archive" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">
                                    Data Pembelajaran
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                        <li class="nav-item">
                            <a href="{{ url('kelas/walas/nilai') }}"
                                class="nav-link  {{ $activeMenu == 'Data Nilai Akhir' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-archive" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">
                                    Data Nilai Akhir
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>

                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'walas'))
                        <li class="nav-item">
                            <a href="{{ url('/siswa_kelas') }}"
                                class="nav-link  {{ $activeMenu == 'Cetak Rapot' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-laptop-code" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">
                                    Cetak Rapot
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item has-treeview">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'guru'))
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-school" style="color: black"></i>
                        <p style="color: black">
                            &nbsp; Guru Mapel
                            <i class="right fas fa-angle-left" style="color: black"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/guru') }}"
                                class="nav-link {{ $activeMenu == 'dashboard guru' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/pembelajaran/guru') }}"
                                class="nav-link {{ $activeMenu == 'Data Pembelajaran' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user" style="color: rgb(3, 3, 3)"></i>
                                <p style="color: rgb(10, 10, 10)">Data Pembelajaran</p>
                            </a>
                        </li>
                    </ul>
                @endif
            </li>


            <li class="nav-item has-treeview">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-users" style="color: black"></i>
                        <p style="color: black">
                            &nbsp; PENGGUNA
                            <i class="right fas fa-angle-left" style="color: black"></i>
                        </p>
                    </a>
                @endif
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('guru') }}"
                                class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Guru</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() &&
                            auth()->user()->roles->contains('nama', 'admin' && 'walas'))
                        <li class="nav-item">
                            <a href="{{ url('siswa') }}"
                                class="nav-link {{ $activeMenu == 'Siswa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Siswa</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item has-treeview">
                @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                    <a href="#" class="nav-link">
                        <i class="fas fa-solid fa-laptop" style="color: black"></i>
                        <p style="color: black">
                            &nbsp; ADMINISTRASI
                            <i class="right fas fa-angle-left" style="color: black"></i>
                        </p>
                    </a>
                @endif
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('sekolah/') }}"
                                class="nav-link {{ $activeMenu == 'Data Sekolah' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Sekolah</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('tahun/ajaran') }}"
                                class="nav-link {{ $activeMenu == 'Tahun Ajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Tahun Ajaran</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('kelas') }}"
                                class="nav-link {{ $activeMenu == 'kelas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Kelas</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('mapel') }}"
                                class="nav-link {{ $activeMenu == 'mapel' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Mapel</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('pembelajaran') }}"
                                class="nav-link {{ $activeMenu == 'pembelajaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Pembelajaran</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
