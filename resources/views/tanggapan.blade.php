@extends('front-navbar')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

@section('konten1')

<style>
    /* Style untuk form-box agar tampil seperti card */
    .form-box {
        border: 1px solid #cccccc; /* Border untuk memberi efek kotak */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        border-radius: 10px; /* Buat sudut lebih halus */
        padding: 20px; /* Padding untuk isi form */
        background-color: white; /* Warna latar belakang form */
        margin-bottom: 20px; /* Tambahkan jarak di bawah */
        margin-top: 20px; /* Tambahkan margin atas sesuai kebutuhan */
    }

    /* Style untuk judul agar lebih menarik */
    .form-box h2 {
        color: #fff; /* Ubah warna teks */
        background-color: #dc3545; /* Warna background merah */
        padding: 25px; /* Padding untuk heading */
        border-radius: 10px 10px 0 0; /* Sudut atas membulat */
        text-align: center; /* Teks ditengah */
        margin-bottom: 20px; /* Ruang di bawah heading */
    }

    .form-check {
        margin-bottom: 7px; /* Memberikan jarak antar form-check */
    }

    .form-check label {
        display: inline-block; /* Mengatur label agar tidak menjorok ke kiri */
        margin-left: 15px; /* Memberikan jarak antara radio button dan label */
    }

    .form-group {
        margin-bottom: 20px; /* Ruang antar form group */
    }

    .btn-primary {
        background-color: #dc3545; /* Sesuaikan warna tombol */
        border: none;
    }

    .btn-primary:hover {
        background-color: #c82333; /* Warna saat hover */
    }
</style>

<div class="container">
    <div class="form-box">
        <h2>Form Isi Tanggapan</h2>
        <form method="POST" action="{{ route('actiontanggapan') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="unit_ruangan">Unit Ruangan:</label>
                <input type="text" class="form-control" id="unit_ruangan" name="unit_ruangan" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-2">
                <p>Pilih Feedback :</p>
                @foreach (['Sangat puas', 'Puas', 'Biasa', 'Tidak puas', 'Sangat tidak puas'] as $value)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="feedback" value="{{ $value }}" id="{{ strtolower(str_replace(' ', '_', $value)) }}">
                    <label class="form-check-label" for="{{ strtolower(str_replace(' ', '_', $value)) }}">
                        {{ $value }}
                    </label>
                </div>
                @endforeach
            </div>

            <div class="form-group" id="kritik_saran_container" style="display: none;">
                <label for="kritik_saran">Kritik dan Saran:</label>
                <textarea class="form-control" id="kritik_saran" name="kritik_saran" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Kirim</button>
        </form>
    </div>
</div>

<script>
    // Sembunyikan textarea kritik_saran saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kritik_saran_container').style.display = 'none';
    });

    // Fungsi untuk menampilkan atau menyembunyikan textarea kritik_saran
    function toggleKritikSaranContainer() {
        var kritikSaranContainer = document.getElementById('kritik_saran_container');
        var radioButtons = document.querySelectorAll('input[name="feedback"]');

        kritikSaranContainer.style.display = Array.from(radioButtons).some(r => r.checked) ? 'block' : 'none';
    }

    // Tambahkan event listener pada setiap radio button
    var radioButtons = document.querySelectorAll('input[name="feedback"]');
    for (var i = 0; i < radioButtons.length; i++) {
        radioButtons[i].addEventListener('click', toggleKritikSaranContainer);
    }
</script>

@endsection
