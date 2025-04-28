<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENGADUAN KERUSAKAN HARDWARE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .bg-red {
            background-color: #dc3545;
        }
        .font-weight-bold {
            color: white !important;
            font-size: 20px;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        #content {
            flex: 1;
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-red"> <!-- Mengganti bg-light menjadi bg-red -->
            <a class="navbar-brand" href="#">
                <img src="/images/huhu.png" alt="Logo" height="30" class="d-inline-block align-top"> <!-- Logo -->
                <span class="font-weight-bold">SIMRS KERUSAKAN HARDWARE</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto"> <!-- Menghapus ml-auto -->
                    <a class="nav-item nav-link font-weight-bold" href="{{ route('visualisasidata') }}">Data Pengaduan</a>
                    <a class="nav-item nav-link font-weight-bold" href="{{ route('riwayatpengaduan') }}">Riwayat Pengaduan</a>
                    <a class="nav-item nav-link font-weight-bold" href="{{ route('riwayattanggapan') }}">Riwayat Tanggapan</a> 
                    @auth
                        <a class="nav-item nav-link font-weight-bold" href="{{ route('actionlogout') }}">Logout</a> <!-- Opsi Logout -->
                    @endauth
                </div>
            </div>
        </nav>

        <div id="content">
            <!-- Your content here -->
            @yield('konten2')
        </div>
        <footer>
            <p>Contact Us: simrspmi@gmail.com</p>
            <p>&copy; 2024 Rumah Sakit PMI Bogor. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
