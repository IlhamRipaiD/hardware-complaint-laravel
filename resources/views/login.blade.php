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
        margin-left: 15px; /* Memberikan jarak antara checkbox dan label */
        width: 20px; /* Lebar checkbox */
        height: 20px; /* Tinggi checkbox */
    }

    .form-check-input {
        width: 20px; /* Lebar checkbox */
        height: 20px; /* Tinggi checkbox */
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
    
    .form-check-label {
        white-space: nowrap; /* Mencegah label untuk turun ke baris berikutnya */
    }

</style>

<div class="container">

    <div class="container form-box">
        <h2>Form Isi Data Pengaduan</h2>

        <form method="POST" action="{{ route('actioninsert') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="unit_ruangan">Unit Ruangan:</label>
                <input type="text" class="form-control" id="unit_ruangan" name="unit_ruangan">
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>

            <div class="form-group">
                <label for="media">Media:</label>
                <select class="form-control" id="media" name="media" style="height: auto; max-height: 200px;">
                    <option value="" disabled selected>Pilih Media Komunikasi</option>
                    <option value="Web Pengaduan">Web Pengaduan</option>
                    <option value="Telepon Internal">Telepon Internal</option>
                </select>
            </div>

            <div class="mb-2">
                <p>Pilih Masalah :</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="Keyboard" id="keyboard">
                    <label class="form-check-label" for="keyboard">Keyboard</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="Monitor" id="monitor">
                    <label class="form-check-label" for="monitor">Monitor</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="CPU" id="cpu">
                    <label class="form-check-label" for="cpu">CPU</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="WIFI" id="wifi">
                    <label class="form-check-label" for="wifi">WIFI</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="Mouse" id="mouse">
                    <label class="form-check-label" for="mouse">Mouse</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="Printer" id="printer">
                    <label class="form-check-label" for="printer">Printer</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="masalah[]" value="Dan lain-lain" id="lainnya">
                    <label class="form-check-label" for="lainnya">Dan lain-lain</label>
                </div>

            </div>

            <div class="form-group" id="detail_masalah_container" style="display: none;">
                <label for="detail_masalah">Isi Detail Masalah:</label>
                <textarea class="form-control" id="detail_masalah" name="detail_masalah" rows="4" cols="50"></textarea>
            </div>

            <div class="col-md-9 pe-5">
                <label for="formFileLg" class="form-label" style="font-size: 1.3rem;">Upload File</label>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="foto" style="font-size: 1.1rem;">
                <div class="form-text mt-2">Upload foto pengaduan jika ada yang ingin dilaporkan secara gambar.</div>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary btn-lg">Kirim</button>
            </div>

        </form>
    </div>
</div>

<script>
    // Sembunyikan textbox detail_masalah saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('detail_masalah_container').style.display = 'none';
    });

    // Fungsi untuk menampilkan atau menyembunyikan textbox detail_masalah
    function toggleIsiMasalahContainer() {
        var isiMasalahContainer = document.getElementById('detail_masalah_container');
        var checkboxes = document.querySelectorAll('input[name="masalah[]"]'); // Memilih semua checkbox
        var isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked); // Cek jika ada yang tercentang

        if (isChecked) {
            isiMasalahContainer.style.display = 'block'; // Tampilkan jika ada yang tercentang
        } else {
            isiMasalahContainer.style.display = 'none'; // Sembunyikan jika tidak ada yang tercentang
        }
    }

    // Tambahkan event listener pada setiap checkbox
    var checkboxes = document.querySelectorAll('input[name="masalah[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', toggleIsiMasalahContainer); // Gunakan event 'change'
    });
</script>

@endsection
