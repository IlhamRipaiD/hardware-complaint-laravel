<!DOCTYPE html>
<html>
<head>
    <title>Rekap Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Rekap Data Pengaduan</h1>
    <p>Periode: {{ $start_date }} sampai {{ $end_date }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Unit Ruangan</th>
                <th>Nama</th>
                <th>Media</th>
                <th>Masalah</th>
                <th>Kategori</th>
                <th>Isi Masalah</th>
                <th>Solusi</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->unit_ruangan }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->media }}</td>
                    <td>{{ str_replace(',', ', ', $data->masalah) }}</td> <!-- Mengganti ',' dengan ', ' -->
                    <td>{{ $data->kategori }}</td>
                    <td>{{ $data->detail_masalah }}</td>
                    <td>{{ str_replace(',', ', ', $data->solusi) }}</td> <!-- Mengganti ',' dengan ', ' -->
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
