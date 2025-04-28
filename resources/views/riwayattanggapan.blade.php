@extends('navbar-admin')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

@section('konten2')
<h4 style="margin-top: 20px; margin-left: 30; margin-bottom: 60px;"> 
<style>
 .table-container {
        padding: 0 5px; /* Tambahkan padding 10 piksel di sebelah kiri dan kanan */
        margin-left: auto; /* Geser ke kiri sejauh 10 piksel */
    margin-right: auto; /* Geser ke kanan sejauh 10 piksel */
    }

    .table-responsive {
        width: 100%; /* Atur lebar tabel menjadi 100% */
        margin: 0 auto 35px; /* Untuk membuat tabel berada di tengah secara horizontal */
    }

    .form-container {
        display: flex; /* Menggunakan flexbox untuk menata elemen secara horizontal */
        justify-content: center; /* Untuk menengahkan .form-container secara horizontal */
    }
    
    .table-container table td {
        padding: 7px; /* Atur ruang antar kolom menjadi 8px */
    }

    .button-container {
        display: flex;
        flex-direction: column; /* Mengubah orientasi menjadi vertical */
        justify-content: center; /* Membuat tombol berada di tengah secara vertical */
        align-items: center; /* Membuat tombol berada di tengah secara horizontal */
        height: 100%; /* Mengisi tinggi sel */
        gap: 10px; /* Memberikan jarak antara tombol */
    }

    .table-container table td:first-child {
        text-align: center; /* Mengatur teks dalam sel pertama menjadi berada di tengah */
    }
</style>

<h3 style="margin-top: 20px; margin-bottom: 15px; text-align: center;">Riwayat Tanggapan</h3>
    <div class="table-container">
        <!-- Tabel Data Tanggapan -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" scope="col" style="text-align: center;">Nomor</th>
                            <th scope="col" scope="col" style="text-align: center;">Unit Ruangan</th>
                            <th scope="col" scope="col" style="text-align: center;">Nama</th>
                            <th scope="col" scope="col" style="text-align: center;">Feedback</th>
                            <th scope="col" scope="col" style="text-align: center;">Kritik dan Saran</th>
                            <th scope="col" scope="col" style="text-align: center;">Created</th>
                            <th scope="col" scope="col" style="text-align: center;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($tanggapan as $t)
                            <tr>
                                <td scope="col" style="text-align: center;">{{ $no++ }}</td>
                                <td scope="col" style="text-align: center;">{{ $t->unit_ruangan }}</td>
                                <td scope="col" style="text-align: center;">{{ $t->nama }}</td>
                                <td scope="col" style="text-align: center;">{{ $t->feedback }}</td>
                                <td scope="col" style="text-align: center;">{{ $t->kritik_saran }}</td>
                                <td scope="col" style="text-align: center;">{{ $t->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="button-container">
                                <div>
                                    <form action="{{ route('delete_tanggapan', $t->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Tabel Data Tanggapan -->
    </div>
@endsection

