@extends('navbar-user')

@section('konten4')
<div class="container">
    <h3 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Pencarian Data Pengaduan User</h3>
    <style>
         .table-container {
            padding: 0 5px; /* Tambahkan padding 10 piksel di sebelah kiri dan kanan */
            margin-left: auto; /* Geser ke kiri sejauh 0 piksel */
            margin-right: auto; /* Geser ke kanan sejauh 0 piksel */
        }

        .table-responsive {
        width: 100%; /* Atur lebar tabel menjadi 100% */
        margin: 1px auto 35px; /* Untuk membuat tabel berada di tengah secara horizontal */
    }
        .table-container table td {
            padding: 7px; /* Atur ruang antar kolom menjadi 8px */
        }

        .table-container table td:first-child {
            text-align: center; /* Mengatur teks dalam sel pertama menjadi berada di tengah */
        }
    </style>
            <form action="{{ route('searchuser') }}" method="GET">
                <div class="form-group">
                    <label for="search" style="font-size: 1.1rem;">Kata Kunci:</label>
                    <input type="text" style="font-size: 1rem;" class="form-control" id="search" name="search" placeholder="Masukkan kata kunci">
                    <div class="form-text mt-2">Kata kunci pencarian: Unit Ruangan, Nama, Masalah, Detail Masalah, Solusi, Status, dan Kategori.</div>
                </div>
                <button type="submit" class="btn btn-info btn-sm btn-block" style="font-size: 1.1rem; margin-bottom: 20px;">Cari</button>
            </form>
        </div>

        @if(isset($riwayatpengaduan))
            <h2 style="font-size: 1.4rem; margin-left: 206px;">   Hasil Pencarian untuk "{{ $searchTerm }}"</h2>
            <div class="container-fluid table-container">
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
                            @foreach($riwayatpengaduan as $index => $result)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $result->unit_ruangan }}</td>
                                    <td>{{ $result->nama }}</td>
                                    <td>{{ $result->media }}</td>
                                    <td>{{ $result->masalah }}</td>
                                    <td>{{ $result->kategori }}</td>
                                    <td style="white-space: normal; word-wrap: break-word;">{{ $result->detail_masalah }}</td>
                                    <td>
                                        <!-- Menggunakan Lightbox -->
                                        <a href="{{ asset('images/' . $result->foto) }}" data-lightbox="roadtrip" data-title="{{ $result->unit_ruangan }}">
                                            <img src="{{ asset('images/' . $result->foto) }}" alt="foto" style="max-width: 100px; height: auto;">
                                        </a>
                                    </td>
                                    <td>{{ $result->solusi }}</td>
                                    <td>{{ $result->status }}</td>
                                    <td style="white-space: nowrap; text-align: center;">
                                        <div>{{ $result->created_at->format('Y-m-d') }}</div>
                                        <div>{{ $result->created_at->format('H:i:s') }}</div>
                                    </td>
                                    <td style="white-space: nowrap; text-align: center;">
                                        <div>{{ $result->updated_at->format('Y-m-d') }}</div>
                                        <div>{{ $result->updated_at->format('H:i:s') }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

    <!-- Sertakan JavaScript Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
