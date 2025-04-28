<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENGADUAN KERUSAKAN HARDWARE</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <style>
        .bg-red {
            background-color: #dc3545;
        }
        .font-weight-bold {
            color: white !important;
            font-size: 20px;
        }
        footer {
            position: relative;
            width: 100%;
            background-color: #dc3545; /* Ganti background dengan merah */
            color: black;
            text-align: center;
            padding: 20px 0;
            color: white !important;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-red"> <!-- Mengganti bg-light menjadi bg-red -->
            <a class="navbar-brand" href="#">
                <img src="/images/huhu.png" alt="Logo" height="30" class="d-inline-block align-top"> <!-- Logo -->
                <span class="font-weight-bold">SIMRS KERUSAKAN HARDWARE</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link font-weight-bold" href="{{ route('user') }}">Pengaduan</a>
                    <a class="nav-item nav-link font-weight-bold" href="{{ route('tanggapan') }}">Tanggapan</a>
                    <button class="nav-item nav-link font-weight-bold btn btn-link" data-toggle="modal" data-target="#loginModal">Admin</button>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div id="content">
            @yield('konten1')
        </div>

        <!-- Footer -->
        <footer>
            <p>Contact Us: simrspmi@gmail.com</p>
            <p>&copy; 2024 Rumah Sakit PMI Bogor. All rights reserved.</p>
        </footer>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('actionlogin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <p class="text-center" style="margin-top: 20px;"><b>Belum punya akun? <a href="{{ route('register') }}" class="gradient-button">Register</a> sekarang!</b></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
