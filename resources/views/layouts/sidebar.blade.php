<div class="sidebar">
    <!-- Sidebar user (optional) -->

    &nbsp;
    <!-- Sidebar Menu -->
    <nav class="ml-10">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                @if (auth()->check() && auth()->user()->level->nama == 'admin')
                    <a href="{{ url('/dashboard/admin') }}" class="nav-link  {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(3, 3, 3)"></i>
                        <p style="color: rgb(10, 10, 10)">
                            Dashboard
                        </p>
                    </a>
                @endif

            </li>
            <li class="nav-item">
                @if (auth()->check() && auth()->user()->level->nama == 'admin')
                    <a href="{{ url('guru') }}" class="nav-link {{ $activeMenu == 'guru' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher" style="color: rgb(16, 15, 15)"></i>
                        <p style="color: rgb(5, 5, 5)">
                            Guru
                        </p>
                    </a>
                @endif
            </li>
            <li class="nav-item">
                @if (auth()->check() && in_array(auth()->user()->level->nama, ['admin', 'guru']))
                    <a href="{{ url('pembelajaran') }}"
                        class="nav-link ">
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