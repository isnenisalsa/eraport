<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="resource/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFCF7;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;


        }

        .logo {
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="image/logo.png" alt="Logo" width="250px">
        </div>
        <form class="card p-4" style="width:500px;" action="{{ url('proses_login') }}" method="POST">
            @csrf
            <div class="card-body login-card-body">
                @error('akses')
                    <span class="text-danger text-center">{{ $message }}</span>
                @enderror
                @error('login_gagal')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('access_denied')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('error')
            <span class="text-danger">{{ $message }}</span>
        @enderror
                <h2 class="mb-3 text-center">Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username"
                        name="username" required>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan password"
                        name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>
