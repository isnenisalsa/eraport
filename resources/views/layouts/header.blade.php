<nav class="main-header navbar navbar-expand navbar-light"
    style="background-color: #25D366;width: -webkit-fill-available;">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-flex align-items-center">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="margin-top: 10%;">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <p class="font-weight-bold" style="margin-top: 6%">SMP IT SIRAJUL HUDA</p>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> <!-- ml-auto makes the icon align to the right -->
        <li class="nav-item dropdown">
            <a class="nav-link fas fa-user fa-2x" href="#" id="navbarDropdown2" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <div class="dropdown-divider"></div>
                <!-- Dropdown untuk user yang terautentikasi -->
                @auth
                    <!-- Jika menggunakan guard 'web' -->
                    @if (Auth::guard('web')->check())
                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                    @endif

                    <!-- Jika menggunakan guard 'siswa' -->
                    @if (Auth::guard('siswa')->check())
                        <a class="dropdown-item" href="{{ route('profile.show.siswa') }}">Profile</a>
                    @endif
                @endauth

                <a class="dropdown-item" data-toggle="modal" data-target="#modal-logout">Logout</a>
            </div>

        </li>
    </ul>
</nav>

@include('logout')
