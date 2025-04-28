<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Pengaduan Kerusakan Hardware</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #FFFFFF, #ADD8E6);
        }
        .gradient-button {
            background: linear-gradient(45deg, #0000FF, #ADD8E6);
            border: none;
            color: black;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .gradient-button:hover {
            background: linear-gradient(45deg, #ADD8E6, #0000FF);
            color: white;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center"><b>SIMRS PMI BOGOR</b><br>PENGADUAN KERUSAKAN HARDWARE KOMPUTER</h2>
        <button class="btn btn-primary gradient-button" data-toggle="modal" data-target="#loginModal">Login Admin</button>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login - SIMRS PMI BOGOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Error Message Handling -->
                    @if(session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b> {{ session('error') }}
                    </div>
                    @endif
                    <!-- Display validation errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('actionlogin') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Emaill address</label>
                            <input type="email" name="email" id="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block gradient-button">Log In</button>
                        <p class="text-center" style="margin-top: 20px;"><b>Belum punya akun? <a href="{{ route('register') }}" class="gradient-button">Register</a> sekarang!</b></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
