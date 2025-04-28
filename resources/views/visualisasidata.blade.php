@extends('navbar-admin')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

@section('konten2')

<h3 style="margin-top: 20px; margin-bottom: 50px; text-align: center;">Visualisasi Pengaduan</h3>

<!-- Dropdown untuk memilih kategori visualisasi -->
<div class="container" style="text-align: center; margin-bottom: 20px;">
    <label for="kategoriVisualisasi">Pilih Kategori Visualisasi:</label>
    <select id="kategoriVisualisasi" class="form-control" style="display: inline-block; width: 200px;">
        <option value="masalah">Masalah</option>
        <option value="unit_ruangan">Unit Ruangan</option>
        <option value="nama">Nama</option>
        <option value="status">Status</option>
    </select>
</div>

<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>

<script>
    // Data yang akan digunakan berdasarkan kategori
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart;

    // Data dari server (PHP) yang dikelompokkan berdasarkan kategori
    @php
    $dataMasalah = [];
    $dataUnitRuangan = [];
    $dataNama = [];
    $dataStatus = [];
    $masalahPerUnitRuangan = [];
    $unitRuanganPerMasalah = []; // Tambahkan ini

    // Data berdasarkan masalah
    foreach ($riwayatpengaduan as $pengaduan) {
        if (!isset($dataMasalah[$pengaduan->masalah])) {
            $dataMasalah[$pengaduan->masalah] = 0;
            $unitRuanganPerMasalah[$pengaduan->masalah] = []; // Tambahkan ini
        }
        $dataMasalah[$pengaduan->masalah]++;
        
        // Tambahkan unit ruangan ke daftar terkait masalah
        if (!in_array($pengaduan->unit_ruangan, $unitRuanganPerMasalah[$pengaduan->masalah])) {
            $unitRuanganPerMasalah[$pengaduan->masalah][] = $pengaduan->unit_ruangan;
        }

        // Data berdasarkan unit ruangan
        if (!isset($dataUnitRuangan[$pengaduan->unit_ruangan])) {
            $dataUnitRuangan[$pengaduan->unit_ruangan] = 0;
            $masalahPerUnitRuangan[$pengaduan->unit_ruangan] = [];
        }
        $dataUnitRuangan[$pengaduan->unit_ruangan]++;
        $masalahPerUnitRuangan[$pengaduan->unit_ruangan][] = $pengaduan->masalah;
    }

    // Data berdasarkan nama
    foreach ($riwayatpengaduan as $pengaduan) {
        if (!isset($dataNama[$pengaduan->nama])) {
            $dataNama[$pengaduan->nama] = 0;
        }
        $dataNama[$pengaduan->nama]++;
    }

    // Data berdasarkan status
    foreach ($riwayatpengaduan as $pengaduan) {
        if (!isset($dataStatus[$pengaduan->status])) {
            $dataStatus[$pengaduan->status] = 0;
        }
        $dataStatus[$pengaduan->status]++;
    }
    @endphp

// Data unit ruangan per masalah
var unitRuanganPerMasalah = @json($unitRuanganPerMasalah);


    // Data visualisasi untuk 'Masalah'
    var dataMasalah = {
        labels: @json(array_keys($dataMasalah)),
        data: @json(array_values($dataMasalah))
    };

    // Data visualisasi untuk 'Unit Ruangan'
    var dataUnitRuangan = {
        labels: @json(array_keys($dataUnitRuangan)),
        data: @json(array_values($dataUnitRuangan))
    };

    // Data visualisasi untuk 'Nama'
    var dataNama = {
        labels: @json(array_keys($dataNama)),
        data: @json(array_values($dataNama))
    };

    // Data visualisasi untuk 'Status'
    var dataStatus = {
        labels: @json(array_keys($dataStatus)),
        data: @json(array_values($dataStatus))
    };

    // Fungsi untuk menggambar chart
    // Event listener untuk chart klik
    function addChartClickListener() {
    document.getElementById('myChart').onclick = function(evt) {
        const activePoints = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, false);
        if (activePoints.length) {
            const index = activePoints[0].index;
            const kategori = document.getElementById('kategoriVisualisasi').value;

            if (kategori === 'unit_ruangan') {
                const unitRuangan = dataUnitRuangan.labels[index];
                const masalahList = masalahPerUnitRuangan[unitRuangan] || [];
                alert('Masalah di ' + unitRuangan + ':\n- ' + masalahList.join('\n- '));
            } else if (kategori === 'masalah') {
                const masalah = dataMasalah.labels[index];
                const unitList = unitRuanganPerMasalah[masalah] || [];
                alert('Unit Ruangan terkait dengan "' + masalah + '":\n- ' + unitList.join('\n- '));
            }
        }
    };
}

// Tambahkan listener setelah chart di-render
function drawChart(labels, data, title) {
    if (chart) {
        chart.destroy();
    }
    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                backgroundColor: getRandomColors(labels.length),
                borderColor: getRandomColors(labels.length),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    ticks: {
                        font: {
                            size: 18
                        }
                    }
                }
            },
            layout: {
                padding: {
                    left: 20,  // Padding kiri
                    right: 20, // Padding kanan
                    top: 30,   // Padding atas
                    bottom: 30 // Padding bawah
                }
            },
            hover: {
                mode: 'index',   // Perbesar area hover
                intersect: false // Deteksi meskipun tidak langsung klik pada bar
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 18,
                        }
                    }
                },
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 24,
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 16,
                    }
                }
            }
        }
    });

    // Tambahkan event listener untuk klik chart
    addChartClickListener();
}



    // Fungsi untuk mendapatkan warna acak
    function getRandomColors(num) {
        const colors = [];
        for (let i = 0; i < num; i++) {
            const color = '#' + Math.floor(Math.random() * 16777215).toString(16);
            colors.push(color);
        }
        return colors;
    }

    // Inisialisasi chart pertama kali dengan data 'Masalah'
    document.addEventListener('DOMContentLoaded', function() {
        drawChart(dataMasalah.labels, dataMasalah.data, 'Jumlah Pengaduan Berdasarkan Masalah');
    });

    // Event listener untuk dropdown kategori visualisasi
    document.getElementById('kategoriVisualisasi').addEventListener('change', function() {
        const kategori = this.value;
        if (kategori === 'masalah') {
            drawChart(dataMasalah.labels, dataMasalah.data, 'Jumlah Pengaduan Berdasarkan Masalah');
        } else if (kategori === 'unit_ruangan') {
            drawChart(dataUnitRuangan.labels, dataUnitRuangan.data, 'Jumlah Pengaduan Berdasarkan Unit Ruangan');
        } else if (kategori === 'nama') {
            drawChart(dataNama.labels, dataNama.data, 'Jumlah Pengaduan Berdasarkan Nama');
        } else if (kategori === 'status') {
            drawChart(dataStatus.labels, dataStatus.data, 'Jumlah Pengaduan Berdasarkan Status');
        }
    });
</script>

@endsection
