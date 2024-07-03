<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regional Admin List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>ID Wilayah</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regionAdmin as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->notelp }}</td>
                    <td>{{ $p->region_id }}</td>
                    <td>{{ $p->region->kecamatan }}</td>
                    <td>{{ $p->region->kelurahan_desa }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
