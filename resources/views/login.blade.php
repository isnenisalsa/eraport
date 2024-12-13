<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap CSS CDN -->
</head>


<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        @if (session('success'))
        <div class="alert alert-danger alert-dismissible fade show position-absolute"
            style="top: 60px; right: 650px; z-index: 9999; animation: fadeOut 3s forwards;" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-10 col-md-6 text-center mb-4">
                <img src="image/logo.png" alt="Logo" width="250px" style="margin-top: 50px">
            </div>
            <div class="col-12 col-md-6">
                <form class="card p-4" style="width: 600px; max-width: 500px;" action="{{ url('proses_login') }}"
                    method="POST">
                    @csrf
                    <div class="card-body">
                        @error('akses')
                            <span class="text-danger text-center d-block">{{ $message }}</span>
                        @enderror
                        @if (session('login_failed'))
                            <div class="alert alert-danger alert-dismissible fade show "
                                style=" animation: fadeOut 3s forwards;" role="alert">
                                <strong>{{ session('login_failed') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @error('access_denied')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                        @error('error')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                       
                        <h2 class="mb-3 text-center">Login</h2>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-lg" id="username"
                                placeholder="Masukkan username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password"
                                placeholder="Masukkan password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
