@extends('navbar-admin')

<!-- Sertakan CSS Lightbox -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-check {
        margin-bottom: 7px; /* Memberikan jarak antar form-check */
    }
    .form-check label {
        display: inline-block; /* Mengatur label agar tidak menjorok ke kiri */
        margin-left: 15px; /* Memberikan jarak antara radio button dan label */
    }
    /* Ubah ukuran checkbox */
    .form-check-input {
        width: 20px; /* Lebar checkbox */
        height: 20px; /* Tinggi checkbox */
    }
</style>

@section('konten2')

<div class="container">
    <h3 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Form Edit Data Pengaduan</h3>

    <form method="POST" action="{{ route('update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Ganti Auth::user() dengan $unit_ruangan -->
        <input type="hidden" name="unit_ruangan" value="{{ $unit_ruangan }}">

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">
        </div>

        <div class="form-group">
            <label for="media">Media:</label>
            <select class="form-control" id="media" name="media" style="height: auto; max-height: 200px;">
                <option value="" disabled selected>Pilih Media Komunikasi</option>
                <option value="Web Pengaduan" {{ $data->media == 'Web Pengaduan' ? 'selected' : '' }}>Web Pengaduan</option>
                <option value="Telepon Internal" {{ $data->media == 'Telepon Internal' ? 'selected' : '' }}>Telepon Internal</option>
            </select>
        </div>

        <div class="mb-2">
    <p>Pilih Masalah :</p>
    @foreach ($allMasalah as $masalah)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="masalah[]" 
                value="{{ $masalah }}" id="masalah_{{ $loop->index }}"
                @if(in_array($masalah, $selectedMasalah)) checked @endif>
            <label class="form-check-label" for="masalah_{{ $loop->index }}">{{ $masalah }}</label>
        </div>
    @endforeach
</div>

        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select class="form-control" id="kategori" name="kategori" style="height: auto; max-height: 200px;">
                <option value="" {{ $data->kategori == '' ? 'selected' : '' }}> </option>
                <option value="Mayor" {{ $data->kategori == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                <option value="Minor" {{ $data->kategori == 'Minor' ? 'selected' : '' }}>Minor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="detail_masalah">Isi Laporan:</label>
            <textarea class="form-control" id="detail_masalah" name="detail_masalah" rows="4" cols="50">{{ $data->detail_masalah }}</textarea>
        </div>

        <div class="col-md-9 pe-5 mb-4"> <!-- Tambahkan mb-4 untuk memberikan margin-bottom -->
            <label for="formFileLg" class="form-label">Upload File</label>
            <input class="form-control form-control-lg" id="formFileLg" type="file" name="foto">
            <div class="form-text mt-2">Upload foto pengaduan jika ada yang ingin dilaporkan secara gambar.</div>
        </div>

        @if($data->foto)
            <div style="margin-top: 10px;">
                <a href="{{ asset('images/'.$data->foto) }}" data-lightbox="image-1">
                    <img src="{{ asset('images/'.$data->foto) }}" alt="Foto Pengaduan" style="width: 150px; height: auto;">
                </a>
                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteFotoForm').submit();">Hapus Foto</button>
            </div>
        @endif

        <div class="form-group">
            <label for="solusi">Solusi:</label>
            <div id="solusi-container">
                <!-- Solusi akan diisi secara dinamis oleh JavaScript -->
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" style="height: auto; max-height: 200px;">
                <option value="" {{ $data->status == '' ? 'selected' : '' }}> </option>
                <option value="Proses" {{ $data->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary btn-lg">Kirim</button>
        </div>
    </form>

    <!-- Form untuk menghapus foto -->
    @if($data->foto)
        <form id="deleteFotoForm" action="{{ route('deleteFoto', $data->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
</div>

<script>
// Data solusi berdasarkan masalah
const solusiData = {
    'keyboard': [
        'Ganti keyboard', 
        'Cek kabel keyboard', 
        'Bersihkan keyboard', 
        'Periksa driver keyboard', 
        'Cek koneksi USB/port', 
        'Periksa pengaturan bahasa keyboard'
    ],
    'mouse': [
        'Ganti mouse', 
        'Periksa koneksi mouse', 
        'Bersihkan sensor mouse', 
        'Ganti baterai mouse', 
        'Periksa driver mouse', 
        'Cek apakah mouse pad bersih'
    ],
    'monitor': [
        'Periksa kabel monitor', 
        'Ganti monitor', 
        'Cek power monitor', 
        'Sesuaikan resolusi layar', 
        'Periksa driver kartu grafis', 
        'Cek apakah ada kerusakan fisik pada layar'
    ],
    'cpu': [
        'Periksa power supply', 
        'Ganti prosesor', 
        'Cek suhu CPU', 
        'Bersihkan kipas pendingin'
    ],
    'wifi': [
        'Periksa router', 
        'Reset pengaturan jaringan', 
        'Ganti kartu jaringan', 
        'Cek sinyal WiFi'
    ],
    'printer': [
        'Ganti cartridge tinta', 
        'Periksa koneksi printer', 
        'Bersihkan kepala printer', 
        'Instal ulang driver printer'
    ]
};

// Menyimpan solusi yang sudah terpilih sebelumnya untuk digunakan dalam updateSolusiOptions
// Menyimpan solusi yang sudah terpilih sebelumnya untuk digunakan dalam updateSolusiOptions
window.selectedSolusi = @json($selectedSolusi); // Ganti dengan data yang diambil dari controller

// Fungsi untuk memperbarui opsi solusi berdasarkan masalah yang dipilih
function updateSolusiOptions() {
    const masalahTerpilih = [];
    document.querySelectorAll('input[name="masalah[]"]:checked').forEach(function(checkbox) {
        masalahTerpilih.push(checkbox.value.toLowerCase());
    });

    const solusiContainer = document.getElementById('solusi-container');
    solusiContainer.innerHTML = ''; // Hapus solusi sebelumnya

    if (masalahTerpilih.length === 0) {
        // Jika tidak ada masalah terpilih, tampilkan solusi yang sudah dipilih sebelumnya
        window.selectedSolusi.forEach(function(solusi) {
            const div = document.createElement('div');
            div.classList.add('form-check');

            const input = document.createElement('input');
            input.type = 'checkbox';
            input.name = 'solusi[]';
            input.value = solusi;
            input.classList.add('form-check-input');
            input.id = `solusi-${solusi.replace(/\s+/g, '-').toLowerCase()}`; // Buat ID unik
            input.checked = true; // Tandai sebagai tercentang

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.htmlFor = input.id;
            label.textContent = solusi;

            // Tambahkan checkbox dan label ke dalam container
            div.appendChild(input);
            div.appendChild(label);
            solusiContainer.appendChild(div);
        });
        return; // Keluar dari fungsi
    }

    masalahTerpilih.forEach(function(masalah) {
        if (solusiData[masalah]) {
            solusiData[masalah].forEach(function(solusi) {
                const div = document.createElement('div');
                div.classList.add('form-check');

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.name = 'solusi[]';
                input.value = solusi;
                input.classList.add('form-check-input');
                input.id = `solusi-${solusi.replace(/\s+/g, '-').toLowerCase()}`; // Buat ID unik

                // Periksa apakah solusi ini sudah dipilih sebelumnya
                if (window.selectedSolusi.includes(solusi)) {
                    input.checked = true; // Tandai sebagai tercentang jika sudah dipilih sebelumnya
                }

                const label = document.createElement('label');
                label.classList.add('form-check-label');
                label.htmlFor = input.id;
                label.textContent = solusi;

                // Tambahkan checkbox dan label ke dalam container
                div.appendChild(input);
                div.appendChild(label);
                solusiContainer.appendChild(div);
            });
        }
    });
}


// Daftarkan event listener pada semua checkbox masalah
document.querySelectorAll('input[name="masalah[]"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', updateSolusiOptions);
});

// Panggil fungsi updateSolusiOptions saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateSolusiOptions);
</script>

@endsection
