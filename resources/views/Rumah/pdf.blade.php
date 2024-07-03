<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px; /* Memberikan jarak antar kolom */
            text-align: center; /* Teks di tengah */
        }
        th {
            background-color: #9cd2e4; /* Warna biru muda */
            color: white; /* Warna teks putih */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>House List</h2>
    <table>
        <thead>
            <tr>
                <th>ID Rumah</th>
                <th>No Rumah</th>
                <th>Alamat</th>
                <th>Luas Rumah (m<sup>2</sup>)</th>
                <th>Status Kepemilikan</th>
                <th>Tahun Dibangun</th>
                <th>Tahun Terakhir Renovasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rumah as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->norumah }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->luas }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->tahun }}</td>
                    <td>{{ $p->renov }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
