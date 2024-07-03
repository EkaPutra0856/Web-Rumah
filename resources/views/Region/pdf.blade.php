<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region List</title>
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
    <h2>Region List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Kode Pos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->kecamatan }}</td>
                    <td>{{ $p->kelurahan_desa }}</td>
                    <td>{{ $p->kode_pos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
