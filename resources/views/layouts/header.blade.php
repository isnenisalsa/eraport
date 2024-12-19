<nav class="main-header navbar navbar-expand  navbar-light" style="background-color: #25D366">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="margin-top: 10%;"><i
                    class="fas fa-bars"></i></a>
        </li>
        <p class="font-weight-bold " style="margin-top: 6%">SMP IT SIRAJUL HUDA</p>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link fas fa-user fa-2x" href="#" id="navbarDropdown2" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#modal-logout">Logout</a>
            </div>
       
        </li>
    </ul>

</nav>
@include('logout')
