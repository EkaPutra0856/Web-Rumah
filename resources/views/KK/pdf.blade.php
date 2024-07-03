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
                <th>ID Rumah</th>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Jumlah Anggota Keluarga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kk as $p)
                <tr>
                    <td>{{ $p->rumah_id }}</td>
                    <td>{{ $p->nokk }}</td>
                    <td>{{ $p->namakk }}</td>
                    <td>{{ $p->anggota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
