@extends('navbar-admin')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
@section('konten2')

<h3 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Riwayat Pengaduan</h3>
<style>
    .table-container {
        padding: 0 20px; /* Tambahkan padding 10 piksel di sebelah kiri dan kanan */
        margin-left: 20px; /* Geser ke kiri sejauh 10 piksel */
        margin-right: 20px; /* Geser ke kanan sejauh 10 piksel */
        margin-top: 15px; /* Tambahkan margin atas untuk jarak dengan tombol */
    }

    .table-container table td {
        padding: 14px; /* Atur ruang antar kolom menjadi 8px */
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

    .form-container {
        display: flex; /* Menggunakan flexbox untuk menata elemen secara horizontal */
        justify-content: center; /* Untuk menengahkan .form-container secara horizontal */
        gap: 20px; /* Tambahkan jarak antar tombol */
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="form-container">
            <div class="form-export">
                <!-- Form Ekspor Data -->
                <a href="{{ route('halExportPDF') }}" class="btn btn-success">Export PDF</a>
            </div>
            <div class="form-search">
                <!-- Form Pencarian Data -->
                <a href="{{ route('search') }}" class="btn btn-info">Cari Data</a>
            </div>
            <div class="form-export">
                <!-- Form Ekspor Data -->
                <a href="{{ route('rekap') }}" class="btn btn-warning">Export Excel dan Rekap Data</a>
            </div>
        </div>
    </div>
</div>

<div class="table-container">
    <!-- Tabel Data Rekap -->
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                        <th scope="col" style="text-align: center; white-space: normal; word-wrap: break-word;">Isi Masalah</th>
                        <th scope="col" style="text-align: center;">Foto</th>
                        <th scope="col" style="text-align: center;">Solusi</th>
                        <th scope="col" style="text-align: center;">Status</th>
                        <th scope="col" style="text-align: center;">Created At</th>
                        <th scope="col" style="text-align: center;">Updated At</th>
                        <th scope="col" style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($riwayatpengaduan) > 0)
                        @foreach($riwayatpengaduan as $index => $pengaduan)
                            <tr>
                                <td scope="col" style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $pengaduan->unit_ruangan }}</td>
                                <td>{{ $pengaduan->nama }}</td>
                                <td>{{ $pengaduan->media }}</td>
                                <td>{{ implode(', ', explode(',', $pengaduan->masalah)) }}</td>
                                <td>{{ $pengaduan->kategori }}</td>
                                <td style="white-space: normal; word-wrap: break-word;">{{ $pengaduan->detail_masalah }}</td>
                                <td>
                                    <a href="{{ asset('images/' . $pengaduan->foto) }}" data-lightbox="roadtrip{{ $index }}" data-title="{{ $pengaduan->foto }}">
                                        <img src="{{ asset('images/' . $pengaduan->foto) }}" alt="foto" style="max-width: 100px; height: auto;">
                                    </a>
                                </td>
                                <td>{{ implode(', ', explode(',', $pengaduan->solusi)) }}</td>
                                <td>{{ $pengaduan->status }}</td>
                                <td style="white-space: nowrap; text-align: center;">
                                    <div>{{ $pengaduan->created_at->format('Y-m-d') }}</div>
                                    <div>{{ $pengaduan->created_at->format('H:i:s') }}</div>
                                </td>
                                <td style="white-space: nowrap; text-align: center;">
                                    <div>{{ $pengaduan->updated_at->format('Y-m-d') }}</div>
                                    <div>{{ $pengaduan->updated_at->format('H:i:s') }}</div>
                                </td>
                                <td class="button-container">
                                <div>
                                    <form action="{{ route('delete', $pengaduan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                                    </form>
                                </div>
                                <div>
                                    <a href="{{ route('edit', $pengaduan->id) }}" class="btn btn-outline-warning">EDIT</a>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data yang ditemukan.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Tabel Data Rekap -->
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="pagination justify-content-center">
            {{-- Tombol Previous --}}
            @if ($riwayatpengaduan->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link btn-lg">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $riwayatpengaduan->previousPageUrl() }}" class="page-link btn-lg" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Tombol Next --}}
            @if ($riwayatpengaduan->hasMorePages())
                <li class="page-item">
                    <a href="{{ $riwayatpengaduan->nextPageUrl() }}" class="page-link btn-lg" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link btn-lg">Next</span>
                </li>
            @endif
        </ul>
        <p class="text-center mt-3" style="font-size: 17px;">
        Menampilkan {{ $riwayatpengaduan->count() }} dari {{ $riwayatpengaduan->total() }} data
        </p>
    </div>
</div>



<!-- Sertakan JavaScript Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

@endsection
