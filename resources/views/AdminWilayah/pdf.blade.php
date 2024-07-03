<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regional Admin List</title>
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
    <h2>Regional Admin List</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>ID Wilayah</th>
                <th>Nama Wilayah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regionAdmin as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->notelp }}</td>
                    <td>{{ $p->region_id }}</td>
                    <td>{{ $p->region->kelurahan_desa }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
