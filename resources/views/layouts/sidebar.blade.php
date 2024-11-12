<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <link rel="stylesheet" href="css/style.css">
    &nbsp;
    <!-- Sidebar Menu -->

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            @if (auth()->check() && auth()->user()->level->nama == 'admin')
                <a href="{{ url('/dashboard/admin') }}"
                    class="nav-link  {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                    <p style="color: rgb(10, 10, 10)">
                        Dashboard
                    </p>
                </a>
            @endif

        </li>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database" style="color: black"></i>
                <p style="color: black">
                    Master Data
                    <i class="right fas fa-angle-left" style="color: black"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if (auth()->check() && auth()->user()->level->nama == 'admin')
                    <li class="nav-item">
                        <a href="{{ url('guru') }}" class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon" style="color: black"></i>
                            <p style="color: black">Guru</p>
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="nav nav-treeview">
                @if (auth()->check() && auth()->user()->level->nama == 'admin')
                    <li class="nav-item">
                        <a href="{{ url('Siswa') }}" class="nav-link {{ $activeMenu == 'Siswa' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon" style="color: black"></i>
                            <p style="color: black">Siswa</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <li class="nav-item">
            @if (auth()->check() && in_array(auth()->user()->level->nama, ['admin', 'guru']))
                <a href="{{ url('pembelajaran') }}" class="nav-link ">
                    <i class="nav-icon fas fa-chalkboard-teacher" style="color: rgb(16, 15, 15)"></i>
                    <p style="color: rgb(5, 5, 5)">
                        pembelajaran

                    </p>
                </a>
            @endif
        </li>

        </nav>
        <!-- /.sidebar-menu -->
</div>
