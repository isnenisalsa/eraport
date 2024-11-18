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
                <a href="#" class="nav-link">

                    <i class="fas fa-solid fa-users" style="color: black"></i>
                    <p style="color: black">
                        &nbsp; PENGGUNA
                        <i class="right fas fa-angle-left" style="color: black"></i>
                    </p>
                    =
                </a>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('guru') }}" class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
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
                            <a href="{{ url('siswa') }}" class="nav-link {{ $activeMenu == 'Siswa' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">Siswa</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-solid fa-laptop" style="color: black"></i>
                    <p style="color: black">
                        &nbsp; ADMINISTRASI
                        <i class="right fas fa-angle-left" style="color: black"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('kelas') }}" class="nav-link {{ $activeMenu == 'kelas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">kelas</p>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->check() && auth()->user()->roles->contains('nama', 'admin'))
                        <li class="nav-item">
                            <a href="{{ url('mapel') }}" class="nav-link {{ $activeMenu == 'mapel' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon" style="color: black"></i>
                                <p style="color: black">mapel</p>
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
                                <p style="color: black">pembelajaran</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
