<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        body {
            background: white;

            font-family: Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            /* Add padding for smaller screens */
        }

        .card {
            background: #fff;
            color: #333;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            /* Default width */
            max-width: 700px;
            /* Limit the max width */
        }

        img {
            margin-top: 100px;
            margin-right: 100px
        }

        .card-body {
            padding: 50px;
            background-color: #f8f9fa;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #37ffb6;
            box-shadow: 0px 0px 8px rgba(106, 17, 203, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, #37ffb6 0%, #2575fc 100%);
            border: none;
            border-radius: 8px;
            font-size: 18px;
            padding: 12px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2575fc 0%, #37ffb6 100%);
            transform: scale(1.05);
        }

        .alert {
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        @media (max-width: 768px) {
            .card {
                margin: 30px;
                /* Add margin for smaller screens */
            }

            .card-body {
                padding: 20px;
                /* Adjust padding for smaller screens */
            }

            .btn-primary {
                font-size: 16px;
                /* Adjust button size */
                padding: 10px;
            }

            .card img {
                width: 120px;
                /* Adjust logo size */
            }

            h2,
            h3,
            h4 {
                font-size: 1.2rem;
                /* Adjust text size for headings */
            }
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 15px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 8px;
            }

            .card img {
                width: 100px;
            }

            h2,
            h3,
            h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7 col-md-4 text-center mb-4">
                <img src="image/logo.png" alt="Logo" width="250px">
            </div>
            <div class="col-xl-8 col-md-10">
                <form class="card" action="{{ url('proses_login') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @error('akses')
                            <span class="text-danger text-center d-block">{{ $message }}</span>
                        @enderror
                        @if (session('success'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('login_failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('login_failed') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h2 class="mb-3 text-center">E-RAPOR</h2>
                        <h3 class="mb-3 text-center">SMP IT SIRAJUL HUDA</h3>
                        <h4 class="mb-3 text-center">Login</h4>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-lg" id="username"
                                placeholder="Masukkan username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg" id="password"
                                    placeholder="Masukkan password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword"
                                    aria-label="Toggle Password Visibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
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
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
