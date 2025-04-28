<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <style>
        /* Style untuk garis yang mengelilingi form */
        .form-border {
            border: 1px solid #000; /* Mengubah warna border menjadi hitam */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        }

        /* Style untuk latar belakang gradient merah muda */
        body {
            background-image: url('/images/RS-PMI-COVID.jpg'); /* Menggunakan gambar background dari public/images */
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif; /* Font keluarga yang lebih halus */
        }

        .form-container {
            background: #FFFFFF; /* Latar belakang putih untuk form-container */
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #000; /* Pinggiran form menjadi garis-garis hitam */
            color: black; /* Warna teks hitam */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        }

        .container {
            background-color: transparent;
        }

        .col-md-6.col-md-offset-3 {
            background: linear-gradient(45deg, #FF8A8A, #FF4D4D); /* Gradasi dari merah muda ke merah terang */
            margin-top: -5vh; /* Atur jarak dari atas */
            padding: 20px; /* Tambahkan padding agar konten tidak menempel ke tepi */
            border-radius: 10px; /* Tambahkan border-radius agar lebih halus */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        }


        h2 {
            font-size: 24px; /* Ukuran font lebih besar */
            margin-bottom: 20px; /* Ruang bawah heading */
            color: black; /* Warna teks hitam */
        }

        p {
            font-size: 16px; /* Ukuran font paragraf */
            color: black; /* Warna teks hitam */
        }

        .form-group label {
            font-size: 14px; /* Ukuran font placeholder */
            display: block; /* Pastikan label berada di atas input */
            margin-bottom: 0.5rem; /* Ruang antara label dan input */
            color: black; /* Warna teks hitam */
        }

        .form-group input {
            border: none;
            border-bottom: 2px solid #ced4da; /* Ketebalan border bawah lebih tebal */
            outline: none;
            width: 100%;
            padding: 0.5rem 0;
            font-size: 16px; /* Ukuran font */
            background-color: transparent;
            color: black; /* Warna teks hitam */
        }

        .form-group input:focus {
            border-color: #ADD8E6; /* Warna border saat fokus */
        }
    </style>
</head>
<body>
    <div class="container"><br>
        <div class="col-md-6 col-md-offset-3">
            <div class="form-container">
                <h2 class="text-center">FORM REGISTER ADMIN</h2>
                <hr>
                @if(session('message'))
                    <div class="alert alert-success">
                        Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan email dan password.
                    </div>
                    @endif
                <div class="form-border">
                    <form action="{{route('actionregister')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label><i class="fa fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-key"></i> Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-address-book"></i> Role</label>
                            <input type="text" name="role" class="form-control" value=" " readonly>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block gradient-button">Register</button>
                    </form>
                </div>
                <hr style="border-top: 1px solid #ccc">
                <p class="text-center" style="margin-top: 20px; font-size: 17px; font-weight: bold;">Sudah punya akun? silahkan <a href="{{route('login')}}" class="btn btn-primary gradient-button">Login Disini!</a></p>
            </div>
        </div>
    </div>
</body>
</html>
