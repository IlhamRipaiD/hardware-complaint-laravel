@extends('navbar-admin')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

@section('konten2')
<h3 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Export PDF</h3>
<style>
   .table-container {
    padding: 0 20px; /* Tambahkan padding 20 piksel di sebelah kiri dan kanan */
    margin-left: 20px; /* Geser ke kiri sejauh 20 piksel */
    margin-right: 20px; /* Geser ke kanan sejauh 20 piksel */
    }

    .table-container table td {
        padding: 14px; /* Atur ruang antar kolom menjadi 14px */
    }

    .table-responsive {
        width: 100%; /* Atur lebar tabel menjadi 100% */
        margin: 0 auto 35px; /* Untuk membuat tabel berada di tengah secara horizontal */
    }

    .form-export-pdf {
        margin-bottom: 20px; /* Geser form ke bawah sejauh 20 piksel */
        margin-left: 10px; /* Geser ke kiri sejauh 10 piksel */
        margin-right: 10px; /* Geser ke kanan sejauh 10 piksel */
    }

    .form-export-pdf form {
        padding: 20px; /* Tambahkan padding 20 piksel di dalam form */
        border: 1px solid #ddd; /* Tambahkan border 1 piksel solid abu-abu */
        border-radius: 5px; /* Tambahkan radius sudut 5 piksel */
        background-color: #f9f9f9; /* Tambahkan latar belakang abu-abu muda */
    }

    .form-export-pdf label {
        margin-bottom: 10px; /* Geser label ke bawah sejauh 10 piksel */
        display: block; /* Ubah label menjadi block element */
        font-weight: bold; /* Beratkan font tebal */
    }

    .form-export-pdf input[type="date"] {
        width: 100%; /* Atur lebar input date menjadi 100% */
        padding: 10px; /* Tambahkan padding 10 piksel di dalam input */
        margin-bottom: 15px; /* Geser input ke bawah sejauh 15 piksel */
        border: 1px solid #ccc; /* Tambahkan border 1 piksel solid abu-abu */
        border-radius: 5px; /* Tambahkan radius sudut 5 piksel */
    }

    .form-export-pdf button[type="submit"] {
        width: 100%; /* Atur lebar tombol submit menjadi 100% */
        padding: 12px; /* Tambahkan padding 12 piksel di dalam tombol */
        background-color: #dc3545; /* Warna latar belakang merah */
        color: #fff; /* Warna teks putih */
        border: none; /* Hapus border */
        border-radius: 5px; /* Tambahkan radius sudut 5 piksel */
        cursor: pointer; /* Ubah cursor menjadi pointer */
    }

    .form-export-pdf button[type="submit"]:hover {
        background-color: #c82333; /* Warna latar belakang hover merah lebih gelap */
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Form Ekspor Data PDF --> 
            <div class="form-export-pdf">
                <form action="{{ route('exportPDF') }}" method="GET" target="_blank">
                    <label for="start_date_pdf">Mulai Tanggal:</label>
                    <input type="date" class="form-control" id="start_date_pdf" name="start_date">

                    <label for="end_date_pdf">Akhir Tanggal:</label>
                    <input type="date" class="form-control" id="end_date_pdf" name="end_date">

                    <button type="submit" class="btn btn-danger btn-block mt-3">Export PDF</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
