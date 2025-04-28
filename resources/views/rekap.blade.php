@extends('navbar-admin')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
@section('konten2')

<h4 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Export Data dan Rekapan Data Pengaduan</h4>
<style>
   .table-container {
    padding: 0 20px; /* Tambahkan padding 10 piksel di sebelah kiri dan kanan */
    margin-left: 20px; /* Geser ke kiri sejauh 10 piksel */
    margin-right: 20px; /* Geser ke kanan sejauh 10 piksel */
    }

    .table-container table td {
        padding: 14px; /* Atur ruang antar kolom menjadi 8px */
    }

    .table-responsive {
        width: 100%; /* Atur lebar tabel menjadi 100% */
        margin: 1px auto 35px; /* Untuk membuat tabel berada di tengah secara horizontal */
    }

    .form-ekspor, .form-rekap {
        margin-bottom: 20px; /* Geser form ke bawah sejauh 20 piksel */
        margin-left: 10px; /* Geser ke kiri sejauh 10 piksel */
        margin-right: 10px; /* Geser ke kanan sejauh 10 piksel */
    }

    .rekap-title {
        font-size: 1.4rem;
        margin-bottom: 20px;
        margin-top: 90px;
    }

    .button-container {
        display: flex;
        flex-direction: column; /* Mengubah orientasi menjadi vertical */
        justify-content: center; /* Membuat tombol berada di tengah secara vertical */
        align-items: center; /* Membuat tombol berada di tengah secara horizontal */
        height: 100%; /* Mengisi tinggi sel */
        gap: 10px; /* Memberikan jarak antara tombol */
    }

    thead {
        text-align: center; /* Mengatur teks dalam semua kolom menjadi berada di tengah */
    }

    th {
        vertical-align: middle; /* Mengatur konten dalam semua sel kolom menjadi berada di tengah secara vertikal */
    }

    .table-container table td {
    padding: 7px; /* Atur ruang antar kolom menjadi 8px */
    }
    
    .table-container table td:first-child {
        text-align: center; /* Mengatur teks dalam sel pertama menjadi berada di tengah */
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
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Form Ekspor Data Excel --> 
            <div class="form-ekspor">
                <form action="{{ route('exporttoexcel') }}" method="GET">
                    <label for="start_date">Mulai Tanggal:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">

                    <label for="end_date">Akhir Tanggal:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">

                    <button type="submit" class="btn btn-success btn-block mt-2">Export Data Excel</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Form Rekap Data --> 
            <div class="form-rekap">
                <form action="{{ route('rekap') }}" method="GET">
                    <label for="start_date">Mulai Tanggal:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">

                    <label for="end_date">Akhir Tanggal:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">

                    <button type="submit" class="btn btn-warning btn-block mt-2">Rekap Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(isset($rekapData) && count($rekapData) > 0)
<div class="table-container">
    <!-- Tabel Data Rekap -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="rekap-title">Hasil Rekap Data untuk tanggal "{{ $start_date }}" sampai "{{ $end_date }}"</h3>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="text-align: center;">Nomor</th>
                        <th scope="col" style="text-align: center;">Unit Ruangan</th>
                        <th scope="col" style="text-align: center;">Nama</th>
                        <th scope="col" style="text-align: center;">Media</th>
                        <th scope="col" style="text-align: center;">Masalah</th>
                        <th scope="col" style="text-align: center;">Kategori</th>
                        <th scope="col" style="text-align: center; white-space: normal; word-wrap: break-word;">Detail Masalah</th>
                        <th scope="col" style="text-align: center;">Foto</th>
                        <th scope="col" style="text-align: center;">Solusi</th>
                        <th scope="col" style="text-align: center;">Status</th>
                        <th scope="col" style="text-align: center;">Created At</th>
                        <th scope="col" style="text-align: center;">Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($rekapData as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->unit_ruangan }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->media }}</td>
                            <td>{{ $data->masalah }}</td>
                            <td>{{ $data->kategori }}</td>
                            <td style="white-space: normal; word-wrap: break-word;">{{ $data->detail_masalah }}</td>
                            <td>
                                <!-- Menggunakan Lightbox -->
                                <a href="{{ asset('images/' . $data->foto) }}" data-lightbox="roadtrip" data-title="{{ $data->unit_ruangan }}">
                                    <img src="{{ asset('images/' . $data->foto) }}" alt="foto" style="max-width: 100px; height: auto;">
                                </a>
                            </td>
                            <td>{{ $data->solusi }}</td>
                            <td>{{ $data->status }}</td>
                            <td style="white-space: nowrap; text-align: center;">
                                 <div>{{ $data->created_at->format('Y-m-d') }}</div>
                                 <div>{{ $data->created_at->format('H:i:s') }}</div>
                            </td>
                            <td style="white-space: nowrap; text-align: center;">
                                <div>{{ $data->updated_at->format('Y-m-d') }}</div>
                                <div>{{ $data->updated_at->format('H:i:s') }}</div>
                            </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Tabel Data Rekap -->
</div>
@else
    <div class="alert alert-warning" role="alert">
        Tidak ada data yang ditemukan.
    </div>
@endif

<!-- Sertakan JavaScript Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
